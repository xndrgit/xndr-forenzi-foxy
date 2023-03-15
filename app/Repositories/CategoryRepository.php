<?php

namespace App\Repositories;

use App\Models\Category;
use Exception;
use Yajra\DataTables\DataTables;

class CategoryRepository extends Repository
{
    public function model()
    {
        return app(Category::class);
    }

    private function makeQuery()
    {
        return $this->model()
            ->with('subcategories');
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
            ->addColumn('action', function ($category) {
                $actionStr = '<div class="d-flex justify-content-center align-items-center">';
                $actionStr .= '<a class="btn btn-sm btn-success rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.categories.show', ['category' => $category->id]) . '">';
                $actionStr .= '<i class="fas fa-eye"></i></a>';

                $actionStr .= '<a class="btn btn-sm btn-primary rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.categories.edit', ['category' => $category->id]) . '">';
                $actionStr .= '<i class="fas fa-edit"></i></a>';
                $actionStr .= '</div>';

                return $actionStr;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * 👉 Save data
     *
     * @param $category
     * @param $request
     *
     * @return void
     */
    public function save(&$category, $request)
    {
        $category->name = $request->input('name') ?: '';
        $category->description = $request->input('description') ?: '';
        $category->img = $request->input('img') ?: '';
        $category->img2 = $request->input('img2') ?: '';
        if ($request->has('color')) {
            $category->color = $request->input('color') ?: '';
        }
        if ($request->has('mini_description')) {
            $category->mini_description = $request->input('mini_description') ?: '';
        }
        $category->updated_at = now();
        $category->save();

        if ($request->has('subcategory_id')) {
            $category->subcategories()->sync($request->input('subcategory_id'));
        }
    }
}
