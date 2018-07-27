@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">{{ __('Prepaid Balance') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('prepaid.store') }}" aria-label="{{ __('Prepaid Balance') }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-4 col-form-label text-md-right">{{ __('Mobile Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input type="tel" class="form-control " placeholder="081xxxxxxx" pattern="[0-9]{10,12}"  name="mobile_phone_number" minlength="7" maxlength="12" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="value" class="col-md-4 col-form-label text-md-right">{{ __('Value') }}</label>
                                <div class="col-md-6">
                                <select name="value" class="form-control">
                                    <option value="10000">10000</option>
                                    <option value="50000">50000</option>
                                    <option value="50000">100000</option>
                                </select>
                                </div>
                            </div>
                            <input type="hidden" value="prepaid balance" name="description">
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