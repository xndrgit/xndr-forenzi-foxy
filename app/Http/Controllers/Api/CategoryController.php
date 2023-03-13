<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::with(['products', 'subcategories', 'subcategories.products'])->paginate(7);

        return response()->json([
            "response" => true,
            "count"    => count($categories),
            "results"  => $categories
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $category = Category::with(['products', 'subcategories', 'subcategories.products'])->findOrFail($id);
        return response()->json([
            "response" => true,
            "results"  => $category
        ]);
    }
}
