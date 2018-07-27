<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('home');
        }
        $orderNumber = $request->has('order_number') ? $request->input('order_number') : "";
        $page = $request->has('page') ? $request->input('order_number') : "1";
        $prepaids = Order::with('prepaid')->where('user_id',Auth::user()->id)->where('id', 'LIKE','%'.$orderNumber.'%')->get()->toArray();
        $products = Order::with('product')->where('user_id',Auth::user()->id)->where('id', 'LIKE','%'.$orderNumber.'%')->get()->toArray();

        $collection = collect([$prepaids, $products])->collapse()->sortBy('created_date')->all();
        return view('order.index', compact('collection'));
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $status = "";
        $range = 0;
        try{
            $description = $request->input('description');
            if($description == "product commerce"){
                $shipping_code = str_random(8);
                $dataUpdate = [
                    'shipping_code' => $shipping_code,
                    'status' => Order::PAID,
                    'pay_date' => Carbon::createFromFormat('Y-m-d H:i:s', now(), config('app.timezone'))
                ];
            } else{
                $data = Order::findOrFail($id);
                $date_created = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at);
                $now = Carbon::createFromFormat('Y-m-d H:i:s', now(), config('app.timezone'));

                $hourPaid = date('H:ia', strtotime($now));
                $botPaid = date('H:ia', strtotime("09:00am"));
                $upPaid = date('H:ia', strtotime("05:00pm"));
                $range = $date_created->diffInMinutes($now);
                if($range <= 5 ){
                    if($hourPaid >= $botPaid && $hourPaid <= $upPaid){
                        $status = Order::SUCCESS;
                        $payDate = $now;
                    } else{
                        $state = array(Order::SUCCESS, Order::FAILED);
                        $key = array_rand($state);
                        $status = $state[$key];
                        $payDate = null;
                    }
                } else{
                    $status = Order::CANCELLED;
                    $payDate = null;
                }

                $dataUpdate = [
                    'status' => $status,
                    'pay_date' => $payDate
                ];
            }
            $data = Order::findOrFail($id)->update($dataUpdate);
            return redirect()->route('order.index')->with('message', 'Payment Berhasil');
        }
        catch(\Throwable $ex){
            return back()->with('failed', $ex->getMessage().$ex->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function payment($id)
    {
        if(!Auth::check()){
            return redirect()->route('home');
        }
        $data = Order::findOrFail($id);
        return view('order.payment',compact('data'));
    }
}
