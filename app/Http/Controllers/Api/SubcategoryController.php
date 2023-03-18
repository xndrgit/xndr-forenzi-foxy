<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Repositories\SubcategoryRepository;
use Illuminate\Http\JsonResponse;

class SubcategoryController extends Controller
{
    protected $repository;

    public function __construct(SubcategoryRepository $subcategoryRepository)
    {
        $this->repository = $subcategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $subcategories = $this->repository->getItems();

        return response()->json([
            'success' => true,
            'result' => $subcategories
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $subcategory = Subcategory::with(['products', 'categories'])->findOrFail($id);
        return response()->json([
            'success' => true,
            'result' => $subcategory
        ]);
    }
}
