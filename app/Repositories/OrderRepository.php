<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Payment;
use App\User;
use Exception;

class OrderRepository extends Repository
{
    public function model()
    {
        return app(Order::class);
    }

    /**
     * 👉 Get user's all orders
     *
     * @param $user_id
     *
     * @return mixed
     */
    public function getAll($user_id)
    {
        return $this->model()
            ->with(['products', 'products.category'])
            ->where('user_id', $user_id)
            ->get();
    }

    /**
     * 👉 Create Order
     *
     * @param $user_id
     *
     * @return mixed|null
     * @throws Exception
     */
    public function create($user_id)
    {
        $user = User::find($user_id);
        $products = $user->products()->get();
        $subtotal = 0;
        $conai = 0; // Initialize the conai variable to 0
        $conai_eur = config('services.site.conai_eur', 5);
        $conai_kg = config('services.site.conai_kg', 5000);
        $iva_pro = config('services.site.iva', 0.22);

        if ($products) {
            foreach ($products as $product) {
                $price = $product->price_saled ?: $product->price;
                $subtotal += $price * $product->pivot->quantity;

                $total_weight = $product->pivot->quantity * $product->weight;
                // Calculate the conai for each product
                $conai += ceil($total_weight / $conai_kg) * $conai_eur * $iva_pro;
            }
        } else {
            return null;
        }

        $iva = round($subtotal * $iva_pro, 2);

        $order = new Order();
        $order->user_id = $user_id;
        $order->order_number = random_int(1, 23234342);
        $order->status = 'in attesa';
        $order->subtotal = $subtotal;
        $order->shipping_cost = 0;
        $order->conai = $conai; // Assign the calculated conai to the order
        $order->iva = $iva;
        $order->total = round(($subtotal + $conai + $iva), 2);
        $order->order_date = now();
        $order->created_at = now();
        $order->updated_at = now();
        $order->save();

        foreach ($products as $product) {
            $order->products()->attach([
                $product->id => [
                    'quantity'   => $product->pivot->quantity,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }

        return $order->id;
    }


    /**
     * 👉 Create payment and update order status
     *
     * @param $user_id
     * @param $orderId
     * @param $params
     *
     * @return void
     */
    public function createPayment($user_id, $orderId, $params)
    {
        $paymentMethods = [
            'bonifico'      => 'Bonifico',
            'alla-consegna' => 'Alla-Consegna'
        ];

        $transaction_id = time();
        $payment = new Payment();
        $payment->order_id = $orderId;
        $payment->transaction_id = $transaction_id;
        $payment->payment_method = $paymentMethods[$params['paymentMethod']];
        $payment->amount = round($params['amount'], 2);
        $payment->payment_status = 'in attesa';  // set static
        $payment->created_at = now();
        $payment->updated_at = now();
        $payment->save();

        $order = Order::find($orderId);
        $order->order_number = $transaction_id;
        $order->status = 'spedito';
        $order->save();

        $user = User::find($user_id);
        if ($user->products()->count()) {
            foreach ($user->products()->get() as $product) {
                if ($product->quantity && $product->quantity > 0 && $product->pivot->quantity) {
                    $product->quantity -= $product->pivot->quantity;
                    $product->save();
                }
            }
        }

        $user->products()->detach();
    }
}
