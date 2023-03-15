<?php

namespace App\Repositories;

use App\Models\Subcategory;
use Exception;
use Yajra\DataTables\DataTables;

class SubcategoryRepository extends Repository
{
    public function model()
    {
        return app(Subcategory::class);
    }

    private function makeQuery()
    {
        return $this->model()
            ->with('products');
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
            ->addColumn('action', function ($subcategory) {
                $actionStr = '<div class="d-flex justify-content-center align-items-center">';
                $actionStr .= '<a class="btn btn-sm btn-success rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.subcategories.show', ['subcategory' => $subcategory->id]) . '">';
                $actionStr .= '<i class="fas fa-eye"></i></a>';

                $actionStr .= '<a class="btn btn-sm btn-primary rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.subcategories.edit', ['subcategory' => $subcategory->id]) . '">';
                $actionStr .= '<i class="fas fa-edit"></i></a>';

                $actionStr .= '<form action="' . route('admin.subcategories.destroy', ['subcategory' => $subcategory->id]) . '" ';
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
     * @param      $subcategory
     * @param      $request
     * @param bool $create
     *
     * @return void
     */
    public function save(&$subcategory, $request, bool $create = false)
    {
        $subcategory->name = $request->input('name') ?: '';
        $subcategory->description = $request->input('description') ?: '';
        if ($create)
            $subcategory->created_at = now();
        $subcategory->updated_at = now();
        $subcategory->save();
    }
}
