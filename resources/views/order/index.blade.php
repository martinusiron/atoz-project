@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form method="GET" action="{{ route('order.index') }}">
                        <div class="row float-right" style="margin-bottom: 10px;margin-top: 10px;margin-right
                        : 10px">
                            <input type="text" class="form-control col-md-8" name="order_number" maxlength="10"
                                   placeholder="Search Order Number ..." value="{{ request()->input('order_number') ? request()->input('order_number') : "" }}"/>
                            &nbsp;
                            <button type="submit" class="btn">Search</button>
                        </div>
                    </form>
                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            <button type="button" class="close"></button>
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <div class="card-header">{{ __('List Order') }}</div>
                    <table class="table table-striped">
                        <tr>
                            <th>Order Number</th>
                            <th>Description</th>
                            <th>Total</th>
                            <th>Information</th>
                        </tr>
                        @if(count($collection) > 0)
                            @for($a = 0; $a < count($collection);$a++)
                                @if(isset($collection[$a]['prepaid']) || isset($collection[$a]['product']))
                                    <tr>
                                        @if(isset($collection[$a]['prepaid']))
                                            <td>{{ $collection[$a]['prepaid']['order_number'] }}</td>
                                            <td>{{ $collection[$a]['prepaid']['value'] }}
                                                for {{ $collection[$a]['prepaid']['mobile_phone_number'] }}</td>
                                            <td>{{ $collection[$a]['prepaid']['total'] }}</td>
                                            <td>
                                                @if($collection[$a]['status'] == "Unpaid" && $collection[$a]['status'] !="Cancelled")
                                                    <a href="{{ route('order.payment', $collection[$a]['prepaid']['order_number']) }}"
                                                       type="button" class="btn">Pay</a>
                                                @else
                                                    {{ $collection[$a]['status'] }}
                                                @endif
                                            </td>
                                        @else
                                            <td>{{ $collection[$a]['product']['order_number'] }}</td>
                                            <td>{{ $collection[$a]['product']['product_name'] }} that
                                                cost {{ $collection[$a]['product']['price'] }}</td>
                                            <td>{{ $collection[$a]['product']['total'] }}</td>
                                            <td>
                                                @if($collection[$a]['status'] == "Unpaid" && $collection[$a]['status'] !="Cancelled")
                                                    <a href="{{ route('order.payment', $collection[$a]['product']['order_number']) }}"
                                                       type="button" class="btn">Pay</a>
                                                @else
                                                    Shippng Code : {{ $collection[$a]['shipping_code'] }}
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endif
                            @endfor
                        @else
                            <td colspan="4" style="text-align: center">Data Not Available</td>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection