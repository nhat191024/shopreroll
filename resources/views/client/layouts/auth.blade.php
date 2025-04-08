@extends('client.layouts.master')
@section('main')
    <div class="h-100">
        <center>
            <img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" class="city__icon">
        </center>
        <h1 class="guide__title"> {{ $title }} </h1>
        <div class="cardAcc card-solid offset-lg-3 col-md-6">
            <div class="card-body">
                @if (session()->has('error'))
                    <marquee direction="right" behavior="alternate" class="alert alert-danger">
                        <i class="fa fa-quote-left"></i> {{ session('error') }}
                    </marquee>
                @endif
                @if (session()->has('message'))
                    <marquee direction="right" behavior="alternate" class="alert alert-info">
                        <i class="fa fa-quote-left"></i> {{ session('message') }}
                    </marquee>
                @endif
                @if (session()->has('success'))
                    <marquee direction="right" behavior="alternate" class="alert alert-success">
                        <i class="fa fa-quote-left"></i> {{ session('success') }}
                    </marquee>
                @endif

                @yield('form-content')

            </div>
        </div>
    </div>
@endsection
