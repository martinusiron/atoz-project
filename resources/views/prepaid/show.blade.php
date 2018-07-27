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
                        Your phone number {{ $data->mobile_phone_number }} will be topped up for {{ $data->value }} after you pay <br />   
                        <a href="{{ route('order.payment', $data->order_number) }}" type="button"  class="btn">Pay Here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>        
@endsection