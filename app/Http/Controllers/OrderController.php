<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use PDF;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkout(Request $request)
    {
        $amount = null;
        if ($request->is_split_bill == 1) {
            $request->validate([
                'payment_method' => 'required',
                'number_of_split' => 'required|numeric|min:2',
            ]);
            $amount = $request->total_price / $request->number_of_split;
        } else {
            $request->validate([
                'payment_method' => 'required',
            ]);
        }

        //random string
        $number = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $word = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        $random = Arr::random($number);
        $randomWord1 = Arr::random($word);
        $randomWord2 = Arr::random($word);
        $slug = $randomWord1 . $random . $randomWord2;

        DB::beginTransaction();
        $newOrder = Order::create([
            'user_id' => Auth()->User()->id,
            'slug' => 'bg-j-' . Carbon::now()->format('ymsdi-') . $slug,
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method,
            'is_split_bill' => $request->is_split_bill,
            'number_of_split' => $request->number_of_split,
            'amount_split_bill' => $amount,
        ]);
        if (!$newOrder) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $cart =  $request->session()->get('cart');
        $getLastOrder = Order::orderBy('created_at', 'desc')->first();
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if ((int)$product->quantity < (int)$item['quantity']) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Product ' . $product->name . ' is not enough or sold out');
            }
            $newProduct = ProductOrder::create([
                'product_id' => $item['id'],
                'order_id' => $getLastOrder->id,
                'quantity' => $item['quantity'],
                'total_price' => $item['subtotal'],
                'note' => $item['note']
            ]);
            if (!$newProduct) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Something went wrong');
            }

            $product->quantity = $product->quantity - $item['quantity'];
            $updatedProduct = $product->save();
            if (!$updatedProduct) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Something went wrong');
            }
        }

        $request->session()->forget('cart');

        $getDate = Carbon::now()->format('Y-m-d');
        $reportlastOrder = DB::table('orders')
            ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->select('orders.*', 'products.name', 'products.price', 'product_orders.quantity', 'product_orders.note', 'product_orders.total_price')
            ->where('orders.id', $getLastOrder->id)
            ->get();
        if (!$reportlastOrder) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong');
        }

        DB::commit();
        return view('pages.cart.success', compact('getDate', 'reportlastOrder', 'getLastOrder'))->with('create', 'Order Success');
    }
    public function print()
    {
        $getLastOrder = Order::orderBy('created_at', 'desc')->first();
        $getDate = Carbon::now()->format('Y-m-d');
        $reportlastOrder = DB::table('orders')
            ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->select('orders.*', 'products.name', 'products.price', 'product_orders.quantity', 'product_orders.note', 'product_orders.total_price')
            ->where('orders.id', $getLastOrder->id)
            ->get();
        return view('pages.cart.print', compact('getDate', 'reportlastOrder', 'getLastOrder'));
    }
    public function pdf()
    {
        // retreive all records from db
        $getLastOrder = Order::orderBy('created_at', 'desc')->first();
        $getDate = Carbon::now()->format('Y-m-d');
        $reportlastOrder = DB::table('orders')
            ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->select('orders.*', 'products.name', 'products.price', 'product_orders.quantity', 'product_orders.note', 'product_orders.total_price')
            ->where('orders.id', $getLastOrder->id)
            ->get();
        // share data to view
        //view()->share('employee', $data);


        $pdf = PDF::loadView('pages.cart.pdf', compact('getDate', 'reportlastOrder', 'getLastOrder'))->setOptions(['defaultFont' => 'sans-serif']);
        // download PDF file with download method
        return $pdf->stream('order-' . $getLastOrder->id . $getLastOrder->created_at . '.pdf');
        //return $pdf->download('pdf_file.pdf');
    }
    public function index()
    {
        $order = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.fullname')
            ->orderBy('orders.created_at', 'desc')
            ->get();
        $orderDay = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.fullname')
            ->whereDate('orders.date', Carbon::today())
            ->orderBy('orders.created_at', 'desc')
            ->get();
        $orderWeek = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.fullname')
            ->whereBetween('orders.date', [Carbon::now()->subDays(7), Carbon::now()])
            ->orderBy('orders.created_at', 'desc')
            ->get();
        $orderMonth = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.fullname')
            ->whereBetween('orders.date', [Carbon::now()->subDays(30), Carbon::now()])
            ->orderBy('orders.created_at', 'desc')
            ->get();

        return view('pages.order.order', compact('order', 'orderDay', 'orderWeek', 'orderMonth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $detail_order = DB::table('orders')
            ->join('product_orders', 'orders.id', '=', 'product_orders.order_id')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->select('orders.*', 'products.name', 'products.price', 'product_orders.quantity', 'product_orders.note', 'product_orders.total_price')
            ->where('orders.id', $order->id)
            ->get();

        return view('pages.order.show', compact('detail_order', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
