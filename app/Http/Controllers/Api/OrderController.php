<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $repository;
    protected $userRepo;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository)
    {
        $this->repository = $orderRepository;
        $this->userRepo = $userRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     *
     * @return JsonResponse
     */
    public function show(Order $order)
    : JsonResponse
    {
        $products = $order->products()->get();
        $order->products = $products;

        return response()->json([
            "response" => true,
            "results"  => $order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request)
    : JsonResponse
    {
        $params = $request->all();
        $user_id = $request->user()->id;

        $this->userRepo->updateUserDetails($user_id, $params);

        $orderId = $this->repository->createOrder($user_id);

        if ($request->has('payment')) {
            $payment = $request->input('payment');
            if (isset($payment['paymentMethod']) && $payment['paymentMethod'] != 'paypal') {
                $this->repository->createPayment($user_id, $orderId, $payment);
            }
        }

        return response()->json([
            'result' => 'success',
            'id' => $orderId
        ]);
    }
}
