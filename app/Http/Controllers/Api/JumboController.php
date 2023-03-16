<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\JumboRepository;
use Illuminate\Http\JsonResponse;

class JumboController extends Controller
{
    protected $repository;

    public function __construct(JumboRepository $jumboRepository)
    {
        $this->repository = $jumboRepository;
    }

    public function index()
    : JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'result' => $this->repository->allJumbos()
        ]);
    }
}
