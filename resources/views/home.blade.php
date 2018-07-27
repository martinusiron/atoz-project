@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (Auth::check())
                            Hello, {{ $data }}
                            <a href="{{ route('prepaid.index') }}" class="btn" style="margin-left: 50px;margin-right: 50px">Need a
                                Prepaid Balance?</a>
                            <a href="{{ route('product.index') }}">Want to buy something?
                        @else
                            Welcome!!!
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
