<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $subcategories = Subcategory::all();
        $category = new Category();

        return view('admin.categories.create', compact('category', 'subcategories'));
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
            'name' => 'required|min:3|max:255'
        ]);

        $category = $this->saveCategory(new Category(), $request);

        return redirect()
            ->route('admin.categories.index')
            ->with('created', $category->name);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     *
     * @return Application|Factory|View
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     *
     * @return Application|Factory|View
     */
    public function edit(Category $category)
    {
        $subcategories = Subcategory::all();

        return view('admin.categories.edit', compact('category', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request  $request
     * @param Category $category
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category)
    : RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $category = $this->saveCategory($category, $request);

        return redirect()
            ->route('admin.categories.show', ['category' => $category->id])
            ->with('edited', $category->name);
    }

    private function saveCategory($category, $request)
    {
        $category->name = $request->input('name') ?: '';
        $category->description = $request->input('description') ?: '';
        $category->img = $request->input('img') ?: '';
        $category->img2 = $request->input('img2') ?: '';
        $category->color = $request->has('color') ? ($request->input('color') ?: '') : '';
        $category->mini_description = $request->has('mini_description') ? ($request->input('mini_description') ?: '') : '';
        $category->updated_at = now();
        $category->save();

        if ($request->has('subcategory_id')) {
            $category->subcategories()->sync($request->input('subcategory_id'));
        }

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category)
    : RedirectResponse
    {
        if ($category->products()->count() > 0 || $category->subcategories()->count() > 0) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', "$category->name cannot be deleted because it is used in the categories and products table. Please unlink from them.");
        } else {
            $deletedCategoryName = $category->name;

            $category->delete();

            return redirect()
                ->route('admin.categories.index')
                ->with('deleted', $deletedCategoryName);
        }
    }
}
