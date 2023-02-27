<?php

namespace App\Repositories;

use App\Models\UserDetail;
use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends Repository
{
    public function model()
    {
        return app(User::class);
    }

    /**
     * Get user's added cart items
     *
     * @param User $user
     *
     * @return Collection
     */
    public function getCartItems(User $user)
    : Collection
    {
        return $user->products()->get()->map(function ($product) {
            $category = $product->category;
            $subcategory = $product->subcategory;

            $product->category = $category;
            $product->subcategory = $subcategory;

            return $product;
        });
    }

    /**
     * Get added products details with subtotal
     *
     * @param User $user
     *
     * @return array
     */
    public function getAddedProductsDetails(User $user)
    : array
    {
        $products = $this->getCartItems($user);

        $subtotal = 0.00;
        foreach ($products as $product) {
            $subtotal += ($product->price_saled ?: $product->price) * $product->pivot->quantity;
        }

        return [$products, $subtotal, sizeof($products->toArray())];
    }

    /**
     * Update user's detail
     *
     * @param $user_id
     * @param $params
     *
     * @return void
     */
    public function updateUserDetails($user_id, $params)
    {
        if (isset($params['user_detail'])) {
            $user = $this->model()->with('user_detail')->where('id', $user_id)->first();
            if (!$user->user_detail) {
                $user_detail = new UserDetail();
            } else {
                $user_detail = $user->user_detail()->first();
            }

            $user_detail->user_id = $user_id;
            $user_detail->surname = $params['user_detail']['surname'] ?? '';
            $user_detail->business_name = $params['user_detail']['business_name'] ?? '';
            $user_detail->notes = $params['user_detail']['notes'] ?? '';
            $user_detail->address = $params['user_detail']['address'] ?? '';
            $user_detail->phone = $params['user_detail']['phone'] ?? '';
            $user_detail->city = $params['user_detail']['city'] ?? '';
            $user_detail->cap = $params['user_detail']['cap'] ?? '';
            $user_detail->province = $params['user_detail']['province'] ?? '';
            $user_detail->state = $params['user_detail']['state'] ?? '';
            $user_detail->pec = $params['user_detail']['pec'] ?? '';
            $user_detail->code_sdi = $params['user_detail']['code_sdi'] ?? '';
            $user_detail->admin = 'registered'; // set static
            $user_detail->created_at = now();
            $user_detail->updated_at = now();
            $user_detail->save();
        }
    }
}
