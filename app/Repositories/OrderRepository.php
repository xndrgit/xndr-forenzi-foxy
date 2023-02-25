<?php

namespace App\Repositories;

use App\Models\Order;

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
}
