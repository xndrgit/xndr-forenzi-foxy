<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Repositories\OrderRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    protected $repository;


//Nel OrderController, all'inizio, viene creato un oggetto OrderRepository e viene messo dentro $repository. Questo è come mettere un'etichetta su una scatola dicendo "Tutte le operazioni sugli ordini sono dentro questa scatola".
    public function __construct(OrderRepository $orderRepository)
    {
        $this->repository = $orderRepository;
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
            ['label' => 'Utente', 'class' => 'text-center'],
            ['label' => 'Numero', 'class' => 'text-center'],
            ['label' => 'Data', 'class' => 'text-center'],
            ['label' => 'Stato Ordine', 'class' => 'text-center'],
            ['label' => 'Stato Pagamento', 'class' => 'text-center'],
            ['label' => 'Totale', 'class' => 'text-center'],
            ['label' => 'Impostazioni', 'class' => 'no-sort unsettled-cols text-center']
        ];

        return view('admin.orders.index', compact('tableColumns'));
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     *
     * @return Application|Factory|View
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     *
     * @return Application|Factory|View
     */
    public function edit(Order $order)
    {

        $products = Product::all();
        $statuses = Order::select('status')->distinct()->get();
        $paymentStatuses = Payment::select('payment_status')->distinct()->get();
        $payment_methods = Payment::select('payment_method')->distinct()->get();

        return view('admin.orders.edit', compact('order', 'statuses', 'products', 'payment_methods', 'paymentStatuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Order   $order
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Order $order)
    : RedirectResponse
    {
        $this->repository->save($order, $request);

        return redirect()
            ->route('admin.orders.show', ['order' => $order->id])
            ->with('edited', $request->input('order_number'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Order $order)
    : RedirectResponse
    {
        $order->payment()->delete();
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('deleted', $order['order_number']);
    }
}
