<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;
use PHPUnit\TextUI\XmlConfiguration\Group;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'is_change_password']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('is_deleted', false)->get();
        if (Auth()->user()->is_admin == 1) {
            return view('home');
        } else {
            return view('home', compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $products = [];
        if (is_null($request->name)) {
            $products = Product::where('is_deleted', false)->get();
        } else {
            $products = Product::where('name', 'like', '%' . $request->name . '%')->where('is_deleted',false)->get();
        }
        return view('home', compact('products'));
    }
    public function create()
    {
        //
    }
    public function report()
    {
        //$productOrder = ProductOrder::all();
        // $productOrderDay = ProductOrder::whereDate('created_at', '=', date('Y-m-d'))->get();
        // $productOrderWeek = ProductOrder::whereBetween('created_at', [date('Y-m-d', strtotime('-7 days')), date('Y-m-d')])->get();
        // $productOrderMonth = ProductOrder::whereBetween('created_at', [date('Y-m-d', strtotime('-30 days')), date('Y-m-d')])->get();
        $productOrder = DB::table('product_orders')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->select('product_orders.*', 'products.name', 'products.price', 'products.sku', DB::raw('SUM(product_orders.quantity) as total_quantity'), (DB::raw('SUM(product_orders.quantity * products.price) as total_price_result')))
            ->groupBy('product_orders.product_id')
            ->get();
        $productOrderDay = DB::table('product_orders')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->select('product_orders.*', 'products.name', 'products.price', 'products.sku', DB::raw('SUM(product_orders.quantity) as total_quantity'), (DB::raw('SUM(product_orders.quantity * products.price) as total_price_result')))
            ->whereDate('product_orders.created_at', Carbon::today())
            ->groupBy('product_orders.product_id')
            ->get();
        $productOrderWeek = DB::table('product_orders')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->select('product_orders.*', 'products.name', 'products.price', 'products.sku', DB::raw('SUM(product_orders.quantity) as total_quantity'), (DB::raw('SUM(product_orders.quantity * products.price) as total_price_result')))
            ->whereBetween('product_orders.created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->groupBy('product_orders.product_id')
            ->get();
        $productOrderMonth = DB::table('product_orders')
            ->join('products', 'product_orders.product_id', '=', 'products.id')
            ->select('product_orders.*', 'products.name', 'products.price', 'products.sku', DB::raw('SUM(product_orders.quantity) as total_quantity'), (DB::raw('SUM(product_orders.quantity * products.price) as total_price_result')))
            ->whereBetween('product_orders.created_at', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('product_orders.product_id')
            ->get();

        //dd($productOrderMonth);
        return view('pages.report.report', compact('productOrder', 'productOrderDay', 'productOrderWeek', 'productOrderMonth'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
