<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends Repository
{
    public function model()
    {
        return app(Product::class);
    }

    /**
     * Search products
     *
     * @param $request
     *
     * @return mixed
     */
    public function getProducts($request)
    {
        $query = $this->model()->with(['category', 'category.subcategories']);

        if ($request->has('searchParams')) {
            $search = $request->input('searchParams');
            if (isset($search['length']) && $search['length'] != '' && !empty($search['length'])) {
                $query = $query->where('length', $search['length']);
            }

            if (isset($search['height']) && $search['height'] != '' && !empty($search['height'])) {
                $query = $query->where('height', $search['height']);
            }

            if (isset($search['width']) && $search['width'] != '' && !empty($search['width'])) {
                $query = $query->where('width', $search['width']);
            }

            if (isset($search['searchStr']) && $search['searchStr'] != '' && !empty($search['searchStr'])) {
                $searchStr = $search['searchStr'];
                $query = $query->where(function ($q) use ($searchStr) {
                    return $q->where('name', 'like', "%$searchStr%")
                        ->orWhere('description', 'like', "%$searchStr%");
                });
            }
        }

        return $query->paginate(12);
    }
}
