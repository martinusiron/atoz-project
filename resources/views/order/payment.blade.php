@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">{{ __('Payment') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('order.update', $data->id) }}" aria-label="{{ __('Payment') }}">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="form-group row">
                                <label for="product" class="col-sm-4 col-form-label text-md-right">{{ __('Order Number') }}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control " name="order_number" value="{{ $data->id }}" disabled="true" />
                                </div>
                            </div>
                            <input type="hidden" name="description" value="{{ $data->description }}" />
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Pay') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>        
@endsection