<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jumbo;
use App\Repositories\JumboRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class JumboController extends Controller
{
    protected $repository;

    public function __construct(JumboRepository $jumboRepository)
    {
        $this->repository = $jumboRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->repository->getAll($request);
        }

        $tableColumns = [
            ['label' => 'ID', 'class' => 'text-center'],
            ['label' => 'Order'],
            ['label' => 'Immagine', 'class' => 'text-center'],
            ['label' => 'Titolo', 'class' => 'text-center'],
            ['label' => 'Descrizione', 'class' => 'text-center text-wrap'],
            ['label' => 'Impostazioni', 'class' => 'no-sort unsettled-cols text-center']
        ];

        return view('admin.jumbos.index', compact('tableColumns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $jumbo = new Jumbo();

        $action = route('admin.jumbos.store');
        $create = true;

        return view('admin.jumbos.edit', compact('jumbo', 'action', 'create'));
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
            'title'       => 'required',
            'description' => 'required',
            'src'         => 'required|file'
        ]);

        $jumbo = new Jumbo();

        $this->repository->save($jumbo, $request, true);

        return redirect()->to(route('admin.jumbos.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function reorder(Request $request)
    : Response
    {
        return $this->repository->reorder($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Jumbo $jumbo
     *
     * @return Application|Factory|View
     */
    public function show(Jumbo $jumbo)
    {
        return view('admin.jumbos.show', compact('jumbo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Jumbo $jumbo
     *
     * @return Application|Factory|View
     */
    public function edit(Jumbo $jumbo)
    {
        $action = route('admin.jumbos.update', ['jumbo' => $jumbo->id]);
        $create = false;

        return view('admin.jumbos.edit', compact('jumbo', 'action', 'create'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Jumbo   $jumbo
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Jumbo $jumbo)
    : RedirectResponse
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required'
        ]);

        $this->repository->save($jumbo, $request, false);

        return redirect()->to(route('admin.jumbos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Jumbo $jumbo
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Jumbo $jumbo)
    : RedirectResponse
    {
        $jumbo->delete();

        return redirect()->to(route('admin.jumbos.index'));
    }
}
