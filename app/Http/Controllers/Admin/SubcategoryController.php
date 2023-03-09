<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subcategory = new Subcategory;
        return view('admin.subcategories.create', compact('subcategory', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'category_id' => 'required|integer',
        ]);

        $subcategory = new Subcategory();
        $subcategory->name = $data['name'];
        $subcategory->category_id = $data['category_id'];
        $subcategory->save();

        return redirect()
            // rinominiamo la variabile post
            ->route('admin.subcategories.index', ['subcategory' => $subcategory])
            ->with('created', $data['name']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategory = Subcategory::findOrFail($id);
        return view('admin.subcategories.edit', compact('subcategory', 'categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $data = $request->all();
        // dd($data);

        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'category_id' => 'required|integer',
        ]);

        $subcategory->name = $data['name'];
        $subcategory->category_id = $data['category_id'];
        $subcategory->save();

        return redirect()
            // rinominiamo la variabile post
            ->route('admin.subcategories.index', ['subcategory' => $subcategory])
            ->with('edited', $data['name']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
        return redirect()
            ->route('admin.subcategories.index')
            ->with('deleted', $subcategory['name']);
    }
}
