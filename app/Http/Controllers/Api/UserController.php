<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    : JsonResponse
    {
        $users = User::with(['user_detail', 'orders'])->paginate(5);

        return response()->json([
            "response" => true,
            "count"    => count($users),
            "results"  => $users
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show()
    : JsonResponse
    {
        $user = User::find(auth()->id());
        $user->user_detail = $user->user_detail()->first();

        return response()->json([
            "response" => true,
            "result"  => $user
        ]);
    }
}
