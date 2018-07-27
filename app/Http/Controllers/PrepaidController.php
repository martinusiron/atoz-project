<?php

namespace App\Http\Controllers;

use App\Prepaid;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PrepaidController extends Controller
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
        return view('prepaid.index');
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
        $value = $request->input('value');
        $total = $value + ((5*$value)/100);
//        try{
            $orders = array(
                'id'    => rand(),
                'user_id' => Auth::user()->id,
                'status' => Order::UNPAID,
                'description' => $request->input('description')
            );
            $ord = Order::firstOrCreate($orders);
            $prepaid =array(
                'mobile_phone_number' => $request->input('mobile_phone_number'),
                'value' => number_format($value,0,",","."),
                'total' => number_format($total,0,",","."),
                'order_number' => $orders['id']
            );
            $prepaidId = Prepaid::firstOrCreate($prepaid);
            return redirect()->route('prepaid.show', $prepaidId->id)->with('message', 'Prepaid Balance Berhasil');;
//        }
//        catch(\Throwable $ex){
//            return back()->with('failed', $ex->getMessage().$ex->getLine());
//        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prepaid  $prepaid
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::check()){
            return redirect()->route('home');
        }
        $data = Prepaid::findOrFail($id);
        return view('prepaid.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prepaid  $prepaid
     * @return \Illuminate\Http\Response
     */
    public function edit(Prepaid $prepaid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prepaid  $prepaid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prepaid $prepaid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prepaid  $prepaid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prepaid $prepaid)
    {
        //
    }
}
