<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PaypalController extends Controller
{
    /**
     * @throws Exception
     * @throws Throwable
     */
    public function payment(Request $request): RedirectResponse
    {
        $provider = new PayPalClient;
        // dd(config('paypal'));
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $user = $request->user();
        $params = $request->all();
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
                        "value"         => $params['amount']
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // update payment table
            $payment = new Payment();
            $payment->order_id = $params['order_id'];
            $payment->transaction_id = $response['id'];
            $payment->payment_method = 'PayPal';    // set static
            $payment->amount = $params['amount'];
            $payment->payment_status = 'pending';  // set static
            $payment->created_at = now();
            $payment->updated_at = now();
            $payment->save();

            // redirect to approve href
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->to('/checkout')
            ->with('error', 'Payment failed');
    }

    /**
     * @throws Throwable
     */
    public function success(Request $request, $user_id): RedirectResponse
    {
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
            }

            return redirect()->to('/')->with('success', 'Transaction complete');
        }

        return redirect()->to('/checkout')
            ->with('error', 'Payment failed');
    }

    /**
     * @throws Throwable
     */
    public function cancel(Request $request, $user_id): RedirectResponse
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
