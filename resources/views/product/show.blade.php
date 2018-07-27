@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p style="text-align:center;">
                        Your Order Number <br />
                        {{ $data->order_number }} <br />
                        Total <br />
                        {{ $data->total }} <br />
                        {{ $data->product_name }} that cost {{ $data->price }} will be shipped to {{ $data->shipping_address }} after you pay <br />
                        @foreach($status as $stat)
                            @if($stat['orders']['status'] == "Unpaid" && $stat['orders']['status'] != "Cancelled")
                                <a href="{{ route('order.payment', $data->order_number) }}" type="button"
                                   class="btn">Pay Here</a>
                            @else
                                {{ $stat['orders']['status'] }}
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>        
@endsection