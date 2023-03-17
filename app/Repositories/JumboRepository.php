<?php

namespace App\Repositories;

use App\Models\Jumbo;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class JumboRepository extends Repository
{
    public function model()
    {
        return app(Jumbo::class);
    }

    private function makeQuery()
    {
        return $this->model()->select('*')->orderBy('order_number');
    }

    public function allJumbos()
    {
        return $this->makeQuery()->get();
    }

    /**
     * 👉 Get all jumbo's data
     *
     * @param $request
     *
     * @return mixed
     * @throws Exception
     */
    public function getAll($request)
    {
        return DataTables::of($this->makeQuery())
            ->editColumn('src', function ($jumbo) {
                return '<img src="' . $jumbo->src . '" class="img-thumbnail img-fluid" alt="" />';
            })
            ->addColumn('action', function ($jumbo) {
                $actionStr = '<div class="d-flex justify-content-center align-items-center">';
                $actionStr .= '<a class="btn btn-sm btn-success rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.jumbos.show', ['jumbo' => $jumbo->id]) . '">';
                $actionStr .= '<i class="fas fa-eye"></i></a>';

                $actionStr .= '<a class="btn btn-sm btn-primary rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.jumbos.edit', ['jumbo' => $jumbo->id]) . '">';
                $actionStr .= '<i class="fas fa-edit"></i></a>';

                $actionStr .= '<form action="' . route('admin.jumbos.destroy', ['jumbo' => $jumbo->id]) . '" ';
                $actionStr .= ' method="post" class="d-inline">';
                $actionStr .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                $actionStr .= '<input type="hidden" name="_method" value="DELETE">';
                $actionStr .= '<button type="submit" class="btn-sm btn-danger rounded-circle">';
                $actionStr .= '<i class="fas fa-trash"></i></button>';
                $actionStr .= '</div>';

                return $actionStr;
            })
            ->rawColumns(['action', 'src'])
            ->make(true);
    }

    /**
     * 👉 Reorder table rows
     *
     * @param $request
     *
     * @return Response
     */
    public function reorder($request)
    : Response
    {
        foreach ($request->input('rows', []) as $row) {
            $this->model()->find($row['id'])->update([
                'order_number' => $row['order_number']
            ]);
        }

        return response()->noContent();
    }

    /**
     * Save jumbo
     *
     * @param $jumbo
     * @param $request
     * @param $create
     *
     * @return void
     */
    public function save(&$jumbo, $request, $create)
    {
        $jumbo->title = $request->input('title');
        $jumbo->description = $request->input('description');

        if ($request->hasFile('src')) {
            $img = $request->file('src');
            $file_name = $img->getClientOriginalName();

            if ($img->isValid()) {
                Storage::putFileAs('jumbos/', $img, $file_name);

                $jumbo->src = asset('storage/jumbos') . '/' . $file_name;
            }
        }

        if ($create)
            $jumbo->created_at = now();

        $jumbo->updated_at = now();

        $jumbo->save();
    }
}
