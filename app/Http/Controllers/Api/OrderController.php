<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Payment;
use App\Models\UserDetail;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    : JsonResponse
    {
        $orders = Order::with('products.category')
            ->where('user_id', Auth::id())
            ->where('status', 'in attesa')
            ->paginate(5);

        return response()->json([
            "response" => true,
            "count"    => count($orders),
            "results"  => $orders
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Request $request)
    : JsonResponse
    {
        $id = $request->user()->id;

        $order = Order::where([
            ['user_id', '=', $id],
            ['status', '=', 'in attesa']
        ])->first();

        $order_product = $request->all();

        if ($order != null) {
            $order_product_exist = Order::table('order_product')->where([
                ['product_id', '=', $order_product['id']],
                ['order_id', '=', $order->id]
            ])->first();

            if ($order_product_exist != null) {
                $product = Product::select('quantity')
                    ->where('id', $order_product_exist->product_id)
                    ->first(); //in product: original qu

                $order_pro = DB::table('order_product')->select('quantity')->where([
                    ['product_id', '=', $order_product_exist->product_id],
                    ['order_id', '=', $order->id]
                ])->first(); //in order_product, qu

                if ($product->quantity < $order_product['quantity'] + $order_pro->quantity)
                    return response()->json([
                        "response" => true,
                        "result"   => 'over quantity'
                    ]);

                DB::table('order_product')->where([
                    ['product_id', '=', $order_product_exist->product_id],
                    ['order_id', '=', $order->id]
                ])->increment('quantity', $order_product['quantity'], ['updated_at' => now()]);
            }
            else {
                DB::table('order_product')->insert([
                    'product_id' => $order_product['id'],
                    'quantity'   => $order_product['quantity'],
                    'order_id'   => $order->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        else {
            $order = new Order();
            $order->user_id = $id;
            $order->order_number = random_int(1, 23234342);
            $order->status = 'in attesa';
            $order->total = 0;
            $order->subtotal = 0;
            $order->shipping_cost = 0;
            $order->conai = 0;
            $order->iva = 0;
            $order->created_at = now();

            if ($order->save()) {
                DB::table('order_product')->insert([
                    'product_id' => $order_product['id'],
                    'quantity'   => $order_product['quantity'],
                    'order_id'   => $order->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            else {
                return response()->json([
                    "response" => true,
                    "result"   => "order creat error"
                ]);
            }
        }

        $order_products = DB::table('order_product')->where([
            'order_id' => $order->id
        ])->get();

        $subtotal = 0.00;
        $rejectedList = [];
        foreach ($order_products as $op) {
            $tmp = Product::select(['quantity', 'price'])->where('id', $op->product_id)->first();

            if ($tmp->quantity > $op->quantity) {
                $subtotal += $tmp->price * $op->quantity;
            }
            else {
                $subtotal += $tmp->price * $tmp->quantity;
                $rejectedList[] = $op->order_id . '->' . $op->product_id;
            }
        }

        $order->subtotal = $subtotal;
        $order->shipping_cost = 0;
        $order->conai = round($subtotal * 22.00 / 100, 2);
        $order->iva = 4.35;
        $order->total = round($subtotal + $subtotal * 22.00 / 100 + 4.35, 2);
        $order->updated_at = now();
        $order->save();

        return response()->json([
            "response"     => true,
            "result"       => $subtotal,
            "productCount" => count($order_products),
            "rejected"     => $rejectedList
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show()
    : JsonResponse
    {
        $order = Order::with('products.category')
            ->where('user_id', Auth::id())
            ->where('status', 'in attesa')
            ->first();

        return response()->json([
            "response" => true,
            "user_id"  => Auth::id(),
            "results"  => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(Request $request, Order $order)
    : JsonResponse
    {
        $params = $request->all();

        $subtotal = 0.00;
        $shipping_cost = 0.00;
        $conai = 0.00;
        $iva = 0.00;

        foreach ($params as $op) {
            DB::table('order_product')->where([
                ['order_id', $order->id],
                ['product_id', $op['id']]
            ])->update([
                'quantity' => $op['quantity']
            ]);

            $tmp = Product::select(['quantity', 'price'])->where('id', $op['id'])->first();
            if ($tmp->attributes['quantity'] < $op['quantity']) {
                $subtotal += floatval($tmp->price) * floatval($op['quantity']);
            }
            $shipping_cost = 0.00;
            $conai = $subtotal * 22.00 / 100;
            $iva = $subtotal * 4.35;
        }

        $total = $subtotal + $shipping_cost + $conai + $iva;

        $order->user_id = $request->user()->id;
        $order->total = $total;
        $order->subtotal = $subtotal;
        $order->shipping_cost = $shipping_cost;
        $order->conai = $conai;
        $order->iva = $iva;
        $order->order_number = random_int(1, 23234342);
        $order->updated_at = now();
        $order->save();

        return response()->json([
            "response" => true,
            "order"    => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id)
    : JsonResponse
    {
        $params = $request->all();
        $ordered_product = DB::table('order_product')
            ->where('order_id', $id)
            ->where('product_id', $params['product_id']);

        if ($ordered_product->delete()) {
            $order = Order::with('products')->find($id);
            if (!$order->products()->count()) {
                $order->delete();
            }

            return response()->json([
                "response" => true
            ]);
        }
        else
            return response()->json([
                "response" => false
            ]);
    }

    /**
     * transmit shipping & payment information
     *
     * @param Request $request
     * @param Order $order
     * @return JsonResponse
     */
    public function transmit(Request $request, Order $order)
    : JsonResponse
    {
        $params = $request->all();
        // update order_product
        // $order = Order::where('user_id', Auth::id())->first();
        $order->status = 'spedito';

        if ($order->save()) {
            // create user_detail
            $user_detail = UserDetail::where('user_id', $request->user()->id)->first();
            if (!$user_detail) {
                $user_detail = new UserDetail();
                $user_detail->user_id = $request->user()->id;
                $user_detail->surname = $params['user_detail']['surname'];
                $user_detail->business_name = $params['user_detail']['business_name'];
                $user_detail->notes = $params['user_detail']['notes'];
                $user_detail->address = $params['user_detail']['address'];
                $user_detail->phone = $params['user_detail']['phone'];
                $user_detail->city = $params['user_detail']['city'];
                $user_detail->cap = $params['user_detail']['cap'];
                $user_detail->province = $params['user_detail']['province'];
                $user_detail->state = $params['user_detail']['state'];
                $user_detail->pec = $params['user_detail']['pec'];
                $user_detail->code_sdi = $params['user_detail']['code_sdi'];
                $user_detail->admin = 'registered'; // set static
                $user_detail->created_at = now();
                $user_detail->updated_at = now();
                $user_detail->save();
            }

            return response()->json([
                'status' => 'success'
            ]);
        }

        return response()->json([
            'status' => 'failed'
        ], 400);
    }
}
