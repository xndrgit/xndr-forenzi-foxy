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

                $actionStr .= '<form action="' . route('admin.categories.destroy', ['category' => $category->id]) . '" ';
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
     * 👉 Save data
     *
     * @param $category
     * @param $request
     * @param bool $create
     * @return void
     */
    public function save(&$category, $request, bool $create = false)
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
        if ($create)
            $category->created_at = now();
        $category->updated_at = now();
        $category->save();

        if ($request->has('subcategory_id')) {
            $category->subcategories()->sync($request->input('subcategory_id'));
        }
    }
}
