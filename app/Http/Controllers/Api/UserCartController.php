<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserCartController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Get all added cart items of a logged-in user.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    : JsonResponse
    {
        return $this->getCartsList($request->user());
    }

    /**
     * Store a newly added cart item
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    : JsonResponse
    {
        $cartItems = $request->input('items');
        $request->user()->products()->detach();
        foreach ($cartItems as $cartItem) {
            $request->user()->products()->attach([
                $cartItem['id'] => [
                    'quantity'   => $cartItem['cart_quantity'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }

        return $this->getCartsList($request->user());
    }

    /**
     * Remove cart item
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    : JsonResponse
    {
        $user_id = auth()->id();

        $user = User::find($user_id);
        $user->products()->detach($id);

        return $this->getCartsList($user);
    }

    /**
     * Get all cart items
     *
     * @param $user
     *
     * @return JsonResponse
     */
    private function getCartsList($user)
    : JsonResponse
    {
        $products = $this->repository->getCartItems($user);

        return response()->json([
            'result'       => 'success',
            'products'     => $products
        ]);
    }
}
