@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">{{ __('Product Commerce') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product.store') }}" aria-label="{{ __('Product Commerce') }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="product" class="col-sm-4 col-form-label text-md-right">{{ __('Product') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control " name="product" maxlength="150" minlength="10" required></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="shipping" class="col-sm-4 col-form-label text-md-right">{{ __('Shipping Address') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control " name="shipping_address" maxlength="150" minlength="10" required></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-4 col-form-label text-md-right">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control " name="price" min="0" required>
                                </div>
                            </div>
                            <input type="hidden" value="product commerce" name="description">
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
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