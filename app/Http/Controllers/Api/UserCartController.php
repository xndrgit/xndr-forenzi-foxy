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
        return response()->json([
            'result'   => 'success',
            'products' => $this->repository->getCartItems($request->user())
        ]);
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
        $request->validate([
            'product_id' => 'required',
            'quantity'   => 'required|integer'
        ]);

        $request->user()->products($request->input('product_id'))->attach([
            'quantity' => $request->input('quantity')
        ]);

        return $this->index($request);
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

        return response()->json([
            'result'   => 'success',
            'products' => $this->repository->getCartItems($user)
        ]);
    }
}
