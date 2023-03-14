<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    protected $repository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    /**
     * 👉 Get all products
     *
     * @param Request $request
     *
     * @return Application|Factory|View|mixed
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->getAll($request);
        }

        $tableColumns = [
            ['label' => 'ID', 'class' => 'text-center'],
            ['label' => 'Categoria', 'class' => 'text-center'],
            ['label' => 'Codice', 'class' => 'text-center'],
            ['label' => 'Nome', 'class' => 'text-center'],
            ['label' => 'Misure', 'class' => 'text-center'],
            ['label' => 'Larghezza', 'class' => 'text-center'],
            ['label' => 'Altezza', 'class' => 'text-center'],
            ['label' => 'Quantità', 'class' => 'text-center'],
            ['label' => 'Prezzo', 'class' => 'text-center'],
            ['label' => 'Impostazioni', 'class' => 'no-sort unsettled-cols text-center']
        ];

        return view('admin.products.index', compact('tableColumns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $product = new Product;
        $categories = Category::all();

        $prints = $this->repository->getUniqueValues('print');
        $colors = $this->repository->getUniqueValues('color');

        $action = route('admin.products.store');
        $create = true;

        return view('admin.products.edit-form', compact(
            'product', 'categories', 'colors', 'prints', 'action', 'create'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    : RedirectResponse
    {
        $request->validate([
            'code'                    => 'required|min:3|max:10|unique:products',
            'name'                    => 'required|min:3|max:255',
            'length'                  => 'required|numeric',
            'height'                  => 'required|numeric',
            'width'                   => 'required|numeric',
            'color'                   => 'required|string',
            'print'                   => 'required|string',
            'description'             => 'required|string',
            'price'                   => 'required|numeric',
            'quantity'                => 'required|integer',
            'img'                     => 'nullable|max:260',
            'mini_description'        => 'required|string',
            'price_saled'             => 'nullable|numeric',
            'weight'                  => 'required|numeric',
            'first_price'             => 'numeric',
            'second_price'            => 'numeric',
            'third_price'             => 'numeric',
            'fourth_price'            => 'numeric',
            'purchasable_in_multi_of' => 'required|integer',
            'category_id'             => 'required|integer',
            'subcategory_id'          => 'required',
        ]);

        $product = new Product();

        $this->repository->save($product, $request);

        return redirect()
            ->route('admin.products.show', ['product' => $product->id])
            ->with('created', $product->name);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     *
     * @return Application|Factory|View
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     *
     * @return Application|Factory|View
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        $prints = $this->repository->getUniqueValues('print');
        $colors = $this->repository->getUniqueValues('color');

        $action = route('admin.products.update', ['product' => $product->id]);
        $create = false;

        return view('admin.products.edit-form', compact(
            'product', 'categories', 'colors', 'prints', 'action', 'create'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product)
    : RedirectResponse
    {
        $request->validate([
            'code'                    => 'required|min:3|max:10|unique:products,code,' . $product->id,
            'name'                    => 'required|min:3|max:255',
            'length'                  => 'required|numeric',
            'height'                  => 'required|numeric',
            'width'                   => 'required|numeric',
            'color'                   => 'required|string',
            'print'                   => 'required|string',
            'description'             => 'required|string',
            'price'                   => 'required|numeric',
            'quantity'                => 'required|integer',
            'img'                     => 'nullable|max:260',
            'mini_description'        => 'required|string',
            'price_saled'             => 'nullable|numeric',
            'weight'                  => 'required|numeric',
            'first_price'             => 'numeric',
            'second_price'            => 'numeric',
            'third_price'             => 'numeric',
            'fourth_price'            => 'numeric',
            'purchasable_in_multi_of' => 'required|integer',
            'category_id'             => 'required|integer',
            'subcategory_id'          => 'required',
        ]);

        $this->repository->save($product, $request);

        return redirect()
            ->route('admin.products.show', ['product' => $product->id])
            ->with('edited', $product->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Product $product)
    : RedirectResponse
    {
        $product->delete();
        return redirect()
            ->route('admin.products.index')
            ->with('deleted', $product['name']);
    }
}
