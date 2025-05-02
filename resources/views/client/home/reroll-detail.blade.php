@extends('client.layouts.master')
@section('main')
    <section class="content">
        <div class="container-fluid">
            <div class="text-center">
                <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" loading="lazy">
            </div>
            <h1 class="guide__title">Shop bán acc Honkai Star Rail và Genshin uy tín hàng đầu Việt Nam</h1>
            <main>
                <div>
                    <div class="container-lg">
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
                        <div class="row item-container">
                            @foreach ($rerollSubCategory as $data)
                                <div class="col-md-3">
                                    <div class="item-bounder">
                                        <div class="item-image-key">
                                            <a href="{{ route('client.reroll.detail.tutorial', ['id' => $data->id]) }}"><img src="{{ asset($data->image) }}" onerror="this.src='https://fakeimg.pl/300x300'" class="square-image" alt="..."></a>
                                        </div>
                                        <div class="item-caption">
                                            <h3 class="title_cate text-center">{{ $data->name }}</h3>
                                            <hr>
                                            <form class="row" method="post" action="{{ route('client.reroll.detail.buy') }}">
                                                @csrf
                                                <input name="reroll_sub_category_id" type="hidden" value="{{ $data->id }}">
                                                <div class="col-5" style="padding-right: 3.5px;padding-left: 3.5px;">
                                                    <select id="package_list_{{ $data->id }}" class="form-control" name="packet_id" required="">
                                                        <option value="">Chọn gói</option>
                                                        @foreach ($data->RerollPackage as $packet)
                                                            <option value="{{ $packet->id }}">{{ number_format($packet->price) }} VNĐ / {{ $packet->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2" data-toggle="tooltip" data-original-title="Số lượng" title="" style="padding-right: 3.5px;padding-left: 3.5px;">
                                                    <input class="form-control" name="amount" type="number" required="" value="1" min="1" style="padding: 0.375rem 0.6rem; min-width: 50px;">
                                                </div>
                                                <div class="col-5" style="padding-right: 3.5px;padding-left: 3.5px;">
                                                    <button class="buy-now btn btn-primary" type="submit" style="width: 100%">Mua ngay
                                                    </button>
                                                </div>
                                            </form>
                                            <div style="height: 10px"></div>
                                            <div class="col-md-12">
                                                <a class="btn btn_left btn_down_guide" href="{{ route('client.reroll.detail.tutorial', ['id' => $data->id]) }}" role="button"><i class="fa fa-photo-video mr-1"></i>TUTORIAL</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </section>
@endsection
