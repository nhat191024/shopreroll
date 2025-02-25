@extends('client.layouts.master')
@section('main')
    <div class="h-100">
        <center>
            <img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" class="city__icon">
        </center>
        <h1 class="guide__title"> {{ $title }} </h1>
        <div class="cardAcc card-solid offset-lg-3 col-md-6">
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fa fa-quote-left"></i> {{ ' ' . session('error') }} <br>
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-info">
                        <i class="fa fa-quote-left"></i> {{ ' ' . session('message') }} <br>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fa fa-quote-left"></i> {{ ' ' . session('success') }} <br>
                    </div>
                @endif

                @yield('form-content')

            </div>
        </div>
    </div>
@endsection
