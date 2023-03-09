<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $subcategories = Subcategory::all();

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $subcategory = new Subcategory();

        return view('admin.subcategories.create', compact('subcategory'));
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
        $subcategory->name = $request->input('name') ?: '';
        $subcategory->description = $request->input('description') ?: '';
        $subcategory->created_at = now();
        $subcategory->updated_at = now();
        $subcategory->save();

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
        return view('admin.subcategories.edit', compact('subcategory'));
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

        $subcategory->name = $request->input('name') ?: '';
        $subcategory->description = $request->input('description') ?: '';
        $subcategory->updated_at = now();
        $subcategory->save();

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
