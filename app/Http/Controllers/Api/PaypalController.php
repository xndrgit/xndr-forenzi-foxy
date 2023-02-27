<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PaypalController extends Controller
{
    /**
     * @throws Exception
     * @throws Throwable
     */
    public function payment(Request $request)
    : RedirectResponse
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $user = $request->user();
        $params = $request->all();
        $orderId = $params['order_id'];

        $response = $provider->createOrder([
            "intent"              => "CAPTURE",
            "application_context" => [
                'return_url' => url('/payment/success/' . $user->id),
                'cancel_url' => url('/payment/cancel/' . $user->id)
            ],
            "purchase_units"      => [
                0 => [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value"         => round($params['amount'], 2)
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // update payment table
            $payment = new Payment();
            $payment->order_id = $orderId;
            $payment->transaction_id = $response['id'];
            $payment->payment_method = 'PayPal';    // set static
            $payment->amount = round($params['amount'], 2);
            $payment->payment_status = 'pending';  // set static
            $payment->created_at = now();
            $payment->updated_at = now();
            $payment->save();

            $order = Order::find($orderId);
            $order->order_number = $response['id'];
            $order->order_date = now();
            $order->save();

            // redirect to approve href
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            Log::error(json_encode($response));
            return redirect()->to('/checkout');
        }
    }

    /**
     * @throws Throwable
     */
    public function success(Request $request, $user_id)
    : RedirectResponse
    {
        $user = User::find($user_id);

        if ($user) {
            $provider = new PayPalClient;

            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                // Process payment success
                $payment = Payment::where('transaction_id', $request['token'])->first();
                if ($payment) {
                    $payment->payment_status = 'success';

                    $order = Order::find($payment->order_id);
                    $order->status = 'pagata';
                    $order->save();

                    $payment->save();

                    $user->products()->detach();

                    return redirect()->to('/confirm/' . $payment->order_id)
                        ->with('success', 'Transaction complete');
                }
            }
        }

        return redirect()->to('/checkout')
            ->with('error', 'Payment failed');
    }

    /**
     * @throws Throwable
     */
    public function cancel(Request $request, $user_id)
    : RedirectResponse
    {
        $user = User::find($user_id);

        if ($user) {
            $provider = new PayPalClient;

            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();

            // Process payment cancel
            $payment = Payment::where('transaction_id', $request['token'])->first();
            if ($payment) {
                $payment->payment_status = 'canceled';

                $order = Order::find($payment->order_id);
                $order->status = 'annullata';
                $order->save();

                $payment->save();
            }
        }

        return redirect()->to('/checkout')
            ->with('error', 'Payment cancelled');
    }
}
