<?php

namespace App\Http\Controllers;

use App\Product;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('home');
        }
        return view('product.index');
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
        $price = $request->input('price');
        $total = $price + 10000;
        try{
            $orders = array(
                'id'    => rand(),
                'user_id' => Auth::user()->id,
                'status' => Order::UNPAID,
                'description' => $request->input('description')
            );
            $ord = Order::firstOrCreate($orders);
            $product =array(
                'product_name' => $request->input('product'),
                'price' => number_format($price,0,",","."),
                'total' => number_format($total,0,",","."),
                'shipping_address' => $request->input('shipping_address'),
                'order_number' => $orders['id']
            );
            $productId = Product::firstOrCreate($product);
            return redirect()->route('product.show', $productId->id)->with('message', 'Product Commerce Berhasil');;
        }
        catch(\Throwable $ex){
            return back()->with('failed', $ex->getMessage().$ex->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::check()){
            return redirect()->route('home');
        }
        $data = Product::findOrFail($id);
        return view('product.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
