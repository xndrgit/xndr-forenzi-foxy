<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
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
            ['label' => 'Color', 'class' => 'text-center'],
            ['label' => 'Impostazioni', 'class' => 'no-sort unsettled-cols text-center']
        ];

        return view('admin.categories.index', compact('tableColumns'));
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

        $action = route('admin.categories.store');
        $create = true;

        return view('admin.categories.edit-form', compact('category', 'subcategories', 'action', 'create'));
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

        $category = new Category();

        $this->repository->save($category, $request);

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

        $action = route('admin.categories.update', ['category' => $category->id]);
        $create = false;

        return view('admin.categories.edit-form', compact('category', 'subcategories', 'action', 'create'));
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

        $this->repository->save($category, $request);

        return redirect()
            ->route('admin.categories.show', ['category' => $category->id])
            ->with('edited', $category->name);
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
