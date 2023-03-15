<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Payment;
use App\User;
use Exception;
use Yajra\DataTables\DataTables;

class OrderRepository extends Repository
{
    public function model()
    {
        return app(Order::class);
    }

    public function makeQuery()
    {
        return $this->model()
            ->select('orders.*', 'users.email', 'payments.payment_status')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('payments', 'orders.id', '=', 'payments.order_id')
            ->with(['user', 'payment']);
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
            ->editColumn('total', function ($order) {
                return '€' . number_format($order->total, 2);
            })
            ->editColumn('status', function ($order) {
                $str = '<span class="badge badge-pill py-1" style="';

                if ($order->status == 'consegnato')
                    $str .= 'background-color: #005c00;">';
                elseif ($order->status == 'annullato')
                    $str .= 'background-color: #8b0000;">';
                elseif ($order->status == 'spedito')
                    $str .= 'background-color: #000066;">';
                elseif ($order->status == 'in attesa')
                    $str .= 'background-color: #cccc00;">';

                $str .= $order->status . '</span>';

                return $str;
            })
            ->editColumn('payment_status', function ($order) {
                if (isset($order->payment) && isset($order->payment->payment_status)) {
                    $str = '<span class="badge badge-pill py-1" style="';

                    if ($order->payment->payment_status == 'successo')
                        $str .= 'background-color: #005c00;">';
                    elseif ($order->payment->payment_status == 'fallito')
                        $str .= 'background-color: #8b0000;">';
                    elseif ($order->payment->payment_status == 'in attesa')
                        $str .= 'background-color: #cccc00;">';

                    $str .= $order->payment->payment_status . '</span>';

                    return $str;
                } else {
                    return 'N/A';
                }
            })
            ->addColumn('action', function ($order) {
                $actionStr = '<div class="d-flex justify-content-center align-items-center">';
                $actionStr .= '<a class="btn btn-sm btn-success rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.orders.show', ['order' => $order->id]) . '">';
                $actionStr .= '<i class="fas fa-eye"></i></a>';

                $actionStr .= '<a class="btn btn-sm btn-primary rounded-circle mr-1" ';
                $actionStr .= ' href="' . route('admin.orders.edit', ['order' => $order->id]) . '">';
                $actionStr .= '<i class="fas fa-edit"></i></a>';

                $actionStr .= '<form action="' . route('admin.orders.destroy', ['order' => $order->id]) . '" ';
                $actionStr .= ' method="post" class="d-inline">';
                $actionStr .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                $actionStr .= '<input type="hidden" name="_method" value="DELETE">';
                $actionStr .= '<button type="submit" class="btn-sm btn-danger rounded-circle">';
                $actionStr .= '<i class="fas fa-trash"></i></button>';
                $actionStr .= '</div>';

                return $actionStr;
            })
            ->rawColumns(['action', 'status', 'payment_status'])
            ->make(true);
    }

    /**
     * 👉 Get user's all orders
     *
     * @param $user_id
     *
     * @return mixed
     */
    public function getAllByUser($user_id)
    {
        return $this->model()
            ->with(['products', 'products.category'])
            ->where('user_id', $user_id)
            ->get();
    }

    /**
     * 👉 Create Order
     *
     * @param $user_id
     *
     * @return mixed|null
     * @throws Exception
     */
    public function create($user_id)
    {
        $user = User::find($user_id);
        $products = $user->products()->get();
        $subtotal = 0;
        $conai = 0; // Initialize the conai variable to 0
        $conai_eur = config('services.site.conai_eur', 5);
        $conai_kg = config('services.site.conai_kg', 5000);
        $iva_pro = config('services.site.iva', 0.22);

        if ($products) {
            foreach ($products as $product) {
                $price = $product->price_saled ?: $product->price;
                $subtotal += $price * $product->pivot->quantity;

                $total_weight = $product->pivot->quantity * $product->weight;
                // Calculate the conai for each product
                $conai += ceil($total_weight / $conai_kg) * $conai_eur * $iva_pro;
            }
        } else {
            return null;
        }

        $iva = round($subtotal * $iva_pro, 2);

        $order = new Order();
        $order->user_id = $user_id;
        $order->order_number = random_int(1, 23234342);
        $order->status = 'in attesa';
        $order->subtotal = $subtotal;
        $order->shipping_cost = 0;
        $order->conai = $conai; // Assign the calculated conai to the order
        $order->iva = $iva;
        $order->total = round(($subtotal + $conai + $iva), 2);
        $order->order_date = now();
        $order->created_at = now();
        $order->updated_at = now();
        $order->save();

        foreach ($products as $product) {
            $order->products()->attach([
                $product->id => [
                    'quantity'   => $product->pivot->quantity,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }

        return $order->id;
    }

    public function save(&$order, $request)
    {
        $data = $request->all();

        if ($request->has('products')) {
            foreach ($request->input('products') as $product) {
                $quantity = $product['quantity'];

                $order->products()->updateExistingPivot($product['product_id'], compact('quantity'));
            }
        }

        $order->order_number = $data['order_number'];
        $order->status = $data['status'];
        $order->shipping_cost = $data['shipping_cost'];
        $order->conai = $data['conai'];
        $order->iva = $data['iva'];
        $order->subtotal = $data['subtotal'];
        $order->total = $data['total'];
        $order->save();

        $order->payment()->update([
            'payment_method' => $request->input('payment_method'),
            'payment_status' => $request->input('payment_status')
        ]);

        $userDetail = $order->user->user_detail()->first();
        $userDetail->surname = $data['surname'];
        $userDetail->address = $data['address'];
        $userDetail->business_name = $data['business_name'];
        $userDetail->cap = $data['cap'];
        $userDetail->city = $data['city'];
        $userDetail->state = $data['state'];
        $userDetail->province = $data['province'];
        $userDetail->notes = $data['notes'];
        $userDetail->phone = $data['phone'];
        $userDetail->pec = $data['pec'];
        $userDetail->code_sdi = $data['code_sdi'];
        $userDetail->save();
    }


    /**
     * 👉 Create payment and update order status
     *
     * @param $user_id
     * @param $orderId
     * @param $params
     *
     * @return void
     */
    public function createPayment($user_id, $orderId, $params)
    {
        $paymentMethods = [
            'bonifico'      => 'Bonifico',
            'alla-consegna' => 'Alla-Consegna'
        ];

        $transaction_id = time();
        $payment = new Payment();
        $payment->order_id = $orderId;
        $payment->transaction_id = $transaction_id;
        $payment->payment_method = $paymentMethods[$params['paymentMethod']];
        $payment->amount = round($params['amount'], 2);
        $payment->payment_status = 'in attesa';  // set static
        $payment->created_at = now();
        $payment->updated_at = now();
        $payment->save();

        $order = Order::find($orderId);
        $order->order_number = $transaction_id;
        $order->status = 'spedito';
        $order->save();

        $user = User::find($user_id);
        if ($user->products()->count()) {
            foreach ($user->products()->get() as $product) {
                if ($product->quantity && $product->quantity > 0 && $product->pivot->quantity) {
                    $product->quantity -= $product->pivot->quantity;
                    $product->save();
                }
            }
        }

        $user->products()->detach();
    }
}
