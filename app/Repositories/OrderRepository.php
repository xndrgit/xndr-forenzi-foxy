<?php

namespace App\Repositories;

use App\Models\Order;
use App\User;

class OrderRepository extends Repository
{
    public function model()
    {
        return app(Order::class);
    }

    /**
     * Get user's all orders
     *
     * @param $user_id
     *
     * @return mixed
     */
    public function getAllOrders($user_id)
    {
        return $this->model()
            ->with(['products', 'products.category'])
            ->where('user_id', $user_id)
            ->get();
    }

    public function createOrder($user_id)
    {
        $user = User::find($user_id);
        $products = $user->products()->get();
        $subtotal = 0;
        if ($products) {
            foreach ($products as $product) {
                $subtotal += ($product->price_saled ?: $product->price) * $product->pivot->quantity;
            }
        } else {
            return null;
        }

        $iva = round($subtotal * 22.00 / 100, 2);

        $order = new Order();
        $order->user_id = $user_id;
        $order->order_number = random_int(1, 23234342);
        $order->status = 'in attesa';
        $order->subtotal = $subtotal;
        $order->shipping_cost = 0;
        $order->conai = 4.35;
        $order->iva = $iva;
        $order->total = round(($subtotal + 4.35 + $iva), 2);
        $order->order_date = now();
        $order->created_at = now();
        $order->updated_at = now();
        $order->save();

        foreach ($products as $product) {
            $order->products()->attach([
                $product->id => [
                    'quantity' => $product->pivot->quantity,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);

            $order->conai = 4.35 * $product->pivot->quantity;
            $order->save();
        }

        return $order->id;
    }
}
