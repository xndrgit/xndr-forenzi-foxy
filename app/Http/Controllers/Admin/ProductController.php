<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
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
            return $this->repository->getAllProducts($request);
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
        $subcategories = Subcategory::all();

        $prints = Product::select('print')->distinct()->get();
        $colors = Product::select('color')->distinct()->get();
        $purchasable_in_multi_of = Product::select('purchasable_in_multi_of')->distinct()->get();
        //* dd($colors);
        return view('admin.products.create', compact('product', 'colors', 'prints', 'categories', 'subcategories', 'purchasable_in_multi_of'));
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
        // $validation = $request->validate($this->validation, $this->validationCustom);
        $data = $request->all();

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

        $product->category_id = $data['category_id'];

        $product->code = $data['code'];
        $product->name = $data['name'];
        $product->length = $data['length'];
        $product->height = $data['height'];
        $product->width = $data['width'];
        $product->color = $data['color'];
        $product->print = $data['print'];

        $product->first_price = $data['first_price'];
        $product->second_price = $data['second_price'];
        $product->third_price = $data['third_price'];
        $product->fourth_price = $data['fourth_price'];

        $product->price = $data['price'];
        $product->price_saled = $data['price_saled'];

        $product->quantity = $data['quantity'];
        $product->weight = $data['weight'];

        $product->purchasable_in_multi_of = $data['purchasable_in_multi_of'];

        if (isset($data['img'])) {
            $product->img = $data['img'];
        }

        $product->mini_description = $data['mini_description'];
        $product->description = $data['description'];

        $product->save();

        return redirect()
            ->route('admin.products.show', ['product' => $product->id])
            // ->route('admin.products.index')
            ->with('created', $data['name']);
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

        $prints = Product::select('print')->distinct()->get();
        $colors = Product::select('color')->distinct()->get();
        $purchasable_in_multi_of = Product::select('purchasable_in_multi_of')->distinct()->get();

        return view('admin.products.edit', compact('product', 'categories', 'colors', 'prints', 'purchasable_in_multi_of'));
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
        $data = $request->all();

        // dd($data);


        // $validation = $request->validate($this->validation, $this->validationCustom);

        $validatedData = $request->validate([
            'code'                    => [
                'required',
                'min:3',
                'max:10',
                Rule::unique('products')->ignore($product->id)
            ],
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


        if (isset($data['img'])) {
            $data['img'] = Storage::put('uploadedProducts', $data['img']);
        }

        //! non dobbiamo creare un new product ma modificare quello scelto
        $product->category_id = $data['category_id'];


        $product->code = $data['code'];
        $product->name = $data['name'];
        $product->length = $data['length'];
        $product->height = $data['height'];
        $product->width = $data['width'];
        $product->color = $data['color'];
        $product->print = $data['print'];

        $product->first_price = $data['first_price'];
        $product->second_price = $data['second_price'];
        $product->third_price = $data['third_price'];
        $product->fourth_price = $data['fourth_price'];

        $product->price = $data['price'];
        $product->price_saled = $data['price_saled'];

        $product->quantity = $data['quantity'];
        $product->weight = $data['weight'];

        $product->purchasable_in_multi_of = $data['purchasable_in_multi_of'];

        if (isset($data['img'])) {
            $product->img = $data['img'];
        }

        $product->mini_description = $data['mini_description'];
        $product->description = $data['description'];

        $product->save();

        if ($request->has('subcategory_id')) {
            $product->subcategories()->sync($request->input('subcategory_id'));
        }


        return redirect()
            ->route('admin.products.show', ['product' => $product->id])
            ->with('edited', $data['name']);
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
