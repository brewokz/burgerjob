<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class ProductController extends Controller
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
    public function index()
    {
        // Query ke database
        $product = Product::all();

        // Hasil query di kirim ke view index.blade.php
        return view('pages.product.product', compact('product'));
    }
    public function getAddToCart(Request $request, Product $product)
    {
        $quantity = $request->quantity;

        //check if quantity is more than 1
        if ($quantity == null) {
            $quantity = 1;
        } else {
            if ($quantity > $product->quantity) {
                return redirect()->back()->with('error', 'Stock is not enough');
            }
            if ($quantity <= 0) {
                return redirect()->back()->with('error', 'Quantity must be more than 0');
            }
            $quantity = $request->quantity;
        }
        $cart = session("cart");
        $cart[$product->id] = [
            'id' => $product->id,
            "sku" => $product->sku,
            "name" => $product->name,
            "price" => $product->price,
            "quantity" => $quantity,
            "subtotal" => $product->price * $quantity,
            "description" => $product->description,
            "note" => $request->note
        ];
        session(["cart" => $cart]);
        //$countCart = $request->session()->increment('count');
        //$countCartDecrement = $request->session()->decrement('count');
        //dd($countCart, $cart);
        return redirect()->route('home')->with('success', ucwords($product->name) . ' added to cart');
        //return redirect("/", compact('countCart'));
    }
    public function showCart(Request $request)
    {
        $getDate = Carbon::now()->format('m/d/Y');
        $cart =  $request->session()->get('cart');

        //checking cart empty
        if ($cart == null) {
            return redirect()->route('home')->with('error', 'Cart is empty');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total = $total + $item['subtotal'];
        };

        return view('pages.cart.cart', compact('cart', 'getDate', 'total'));
    }
    public function deleteToCart(Request $request, Product $product)
    {
        $cart = session('cart');
        unset($cart[$product->id]);
        session(['cart' => $cart]);
        return redirect()->route('cart')->with('remove', 'Product has been removed');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|unique:products',
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'product_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        //image name
        $imageName = time() . '_product.' . $request->product_picture->extension();
        $request->product_picture->move(public_path('product-images'), $imageName);

        Product::create([
            'sku' => $request->sku,
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
            'product_picture' => $imageName
        ]);
        return redirect('product')->with('create', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $getOneRow = null;
        $cart =  session()->get('cart');
        if ($cart != null) {
            foreach ($cart as $item) {
                if ($item['id'] == $product->id) {
                    $getOneRow = $item;
                }
            }
        }

        //dd($getOneRow['note']);
        return view('pages.product.show', compact('product', 'getOneRow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('pages.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'sku' => ['required', Rule::unique('products', 'sku')->ignore($product->id)],
            'name' => 'required',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
            'product_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ((int)$request->quantity < 0) {
            return redirect('product')->with('error', 'Quantity must be more than 0');
        }

        if ($request->hasFile('product_picture')) {
            //image name
            $imageName = time() . '_product.' . $request->product_picture->extension();
            $request->product_picture->move(public_path('product-images'), $imageName);
            Product::where('id', $product->id)
                ->update([
                    'sku' => $request->sku,
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'description' => $request->description,
                    'product_picture' => $imageName
                ]);
        } else {
            Product::where('id', $product->id)
                ->update([
                    'sku' => $request->sku,
                    'name' => $request->name,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'description' => $request->description
                ]);
        }
        return redirect('product')->with('change', 'Product Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            Product::destroy($product->id);
            return redirect('product')->with('delete', 'Product deleted successfully!');
        } catch (Throwable $e) {
            report($e);
            return redirect('product')->with('delete', 'Product can not be deleted!');
            //return false;
        }
    }
}
