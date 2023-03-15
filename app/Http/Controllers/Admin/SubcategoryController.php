<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Repositories\SubcategoryRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
            ['label' => 'Nome', 'class' => 'text-center'],
            ['label' => 'Impostazioni', 'class' => 'no-sort unsettled-cols text-center']
        ];

        return view('admin.subcategories.index', compact('tableColumns'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subcategory $subcategory
     *
     * @return Application|Factory|View
     */
    public function show(Subcategory $subcategory)
    {
        return view('admin.subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $subcategory = new Subcategory();

        $action = route('admin.subcategories.store');
        $create = true;

        return view('admin.subcategories.edit-form', compact('subcategory', 'action', 'create'));
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

        $subcategory = new Subcategory();

        $this->repository->save($subcategory, $request, true);

        return redirect()
            ->route('admin.subcategories.index')
            ->with('created', $request->input('name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subcategory $subcategory
     *
     * @return Application|Factory|View
     */
    public function edit(Subcategory $subcategory)
    {
        $action = route('admin.subcategories.update', ['subcategory' => $subcategory->id]);
        $create = false;

        return view('admin.subcategories.edit-form', compact('subcategory', 'action', 'create'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request     $request
     * @param Subcategory $subcategory
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Subcategory $subcategory)
    : RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);

        $this->repository->save($subcategory, $request);

        return redirect()
            ->route('admin.subcategories.index')
            ->with('edited', $request->input('name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subcategory $subcategory
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Subcategory $subcategory)
    : RedirectResponse
    {
        if ($subcategory->products()->count() > 0 || $subcategory->categories()->count() > 0) {
            return redirect()
                ->route('admin.subcategories.index')
                ->with('error', "$subcategory->name cannot be deleted because it is used in the categories and products table. Please unlink from them.");
        } else {
            $deletedCategoryName = $subcategory->name;

            $subcategory->delete();

            return redirect()
                ->route('admin.subcategories.index')
                ->with('deleted', $deletedCategoryName);
        }
    }
}
