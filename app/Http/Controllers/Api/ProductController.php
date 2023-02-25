<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    : JsonResponse
    {
        $products = Product::with('category')->paginate(8);
        return response()->json([
            "response"     => true,
            "count"        => $products->total(),
            "per_page"     => $products->perPage(),
            "current_page" => $products->currentPage(),
            "last_page"    => $products->lastPage(),
            "results"      => $products->items(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    : JsonResponse
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json([
            "response" => true,
            "results"  => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy(int $id)
    : Response
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function siblings($id)
    : JsonResponse
    {
        $product = Product::findOrFail($id);
        $category_id = $product['category_id'];

        $siblings = Product::where([
            ['category_id', '=', $category_id],
            ['id', '!=', $id]
        ])->get();

        return response()->json([
            "response" => true,
            "results"  => $siblings
        ]);
    }
}
