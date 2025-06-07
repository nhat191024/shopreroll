@extends('client.layouts.master')

@section('main')
    <section class="content">
        <div class="container-fluid">
            <div class="text-center">
                <img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" class="city__icon"
                    loading="lazy">
            </div>
            <h1 class="guide__title">Shop bán acc Honkai Star Rail và Genshin uy tín hàng đầu Việt Nam</h1>
            {{-- 'rerollSubCategory', 'rerollSubCategoryPackages' --}}
            <main>
                <div>
                    <div class="container">
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
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="glass-panel p-3 rounded">
                                    <div class="row">
                                        @foreach ($rerollSubCategoryPackages as $packet)
                                            <div class="col-md-2 col-6 mb-3 border border-light-gray rounded mr-3">
                                                <form method="post" action="{{ route('client.reroll.detail.buy') }}">
                                                    @csrf
                                                    <input type="hidden" name="reroll_sub_category_id" value="{{ $rerollSubCategory[0]->id }}">
                                                    <input type="hidden" name="packet_id" value="{{ $packet->id }}">
                                                    <input type="hidden" name="amount" value="1">
                                                    <button type="submit" name="submit" class="w-100 border-0 bg-transparent">
                                                        <div class="small amount_key">
                                                            SL còn {{ $packet->RerollKey->where('status', 1)->count() }}
                                                        </div>
                                                        <div class="tool-item">
                                                            <div class="text-center">
                                                                <i class="fa fa-cart-plus mr-1"></i> {{ $packet->name }}<br>
                                                                <i class="fa fa-coins mr-1"></i> {{ number_format($packet->price) }}đ<sup></sup>
                                                            </div>
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 tool-review">
                                <div class="tool-review-bounder">
                                    <div class="col-xs-12 col-md-6 tool-download glass-panel p-3 rounded" style="padding-right: 0">
                                        <div class="text-justify">
                                            <h4 class="page-header">
                                                Hướng dẫn
                                            </h4>
                                            {!! $rerollSubCategory[0]->tutorial !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <style>
                .glass-panel {
                    background-color: rgba(255, 255, 255, 0.15);
                    backdrop-filter: blur(20px);
                    -webkit-backdrop-filter: blur(10px);
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }
            </style>
        </div>
    </section>
@endsection
