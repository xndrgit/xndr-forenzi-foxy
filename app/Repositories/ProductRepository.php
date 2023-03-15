<?php

namespace App\Repositories;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductRepository extends Repository
{
    public function model()
    {
        return app(Product::class);
    }

    /**
     * @return mixed
     */
    private function makeQuery()
    {
        return $this->model()
            ->select(
                'products.*',
                DB::raw('categories.name as category_name')
            )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->with(['category', 'subcategories', 'category.subcategories']);
    }

    /**
     * @param $request
     *
     * @return mixed
     * @throws Exception
     */
    public function getAll($request)
    {
        return DataTables::of($this->makeQuery())
            ->editColumn('price', function ($product) {
                return '€' . number_format($product->price, 2);
            })
            ->editColumn('length', function ($product) {
                return $product->length . ' x ' . $product->width . ' x ' . $product->height;
            })
            ->addColumn('action', function ($product) {
                $actionStr = '<div class="d-flex justify-content-center align-items-center">';
                $actionStr .= '<a class="btn btn-sm btn-success rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.products.show', ['product' => $product->id]) . '">';
                $actionStr .= '<i class="fas fa-eye"></i></a>';

                $actionStr .= '<a class="btn btn-sm btn-primary rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.products.edit', ['product' => $product->id]) . '">';
                $actionStr .= '<i class="fas fa-edit"></i></a>';

                $actionStr .= '<form action="' . route('admin.products.destroy', ['product' => $product->id]) . '" ';
                $actionStr .= ' method="post" class="d-inline">';
                $actionStr .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                $actionStr .= '<input type="hidden" name="_method" value="DELETE">';
                $actionStr .= '<button type="submit" class="btn-sm btn-danger rounded-circle">';
                $actionStr .= '<i class="fas fa-trash"></i></button>';
                $actionStr .= '</div>';

                return $actionStr;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Search products
     *
     * @param $request
     *
     * @return mixed
     */
    public function search($request)
    {
        $query = $this->model()->with(['category', 'subcategories', 'category.subcategories']);

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

    /**
     * 👉 Get unique values for the column
     *
     * @param $column
     *
     * @return mixed
     */
    public function getUniqueValues($column)
    {
        return $this->model()->distinct()->pluck($column);
    }

    /**
     * 👉 Save product values
     *
     * @param $product
     * @param $request
     *
     * @return void
     */
    public function save(&$product, $request)
    {
        $data = $request->all();

        $product->category_id = $data['category_id'] ?: '';

        $product->code = $data['code'] ?: '';
        $product->name = $data['name'] ?: '';
        $product->length = $data['length'] ?: 0;
        $product->height = $data['height'] ?: 0;
        $product->width = $data['width'] ?: 0;
        $product->color = $data['color'] ?: '';
        $product->print = $data['print'] ?: '';

        $product->first_price = $data['first_price'] ?: 0;
        $product->second_price = $data['second_price'] ?: 0;
        $product->third_price = $data['third_price'] ?: 0;
        $product->fourth_price = $data['fourth_price'] ?: 0;

        $product->price = $data['price'] ?: 0;
        $product->price_saled = $data['price_saled'] ?: 0;

        $product->quantity = $data['quantity'] ?: 0;
        $product->weight = $data['weight'] ?: 0;

        $product->purchasable_in_multi_of = $data['purchasable_in_multi_of'] ?: '';

        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $file_name = $img->getClientOriginalName();

            if ($img->isValid()) {
                Storage::putFileAs('uploadedProduct/', $img, $file_name);

                $product->img = asset('storage/uploadedProduct') . '/' . $file_name;
            }
        }

        $product->mini_description = $data['mini_description'] ?: '';
        $product->description = $data['description'] ?: '';

        $product->save();

        if ($request->has('subcategory_id')) {
            $product->subcategories()->sync($request->input('subcategory_id'));
        }
    }
}
