@extends('client.layouts.master')

@section('main')
    <section class="content">
        <div class="container-fluid">
            <div class="mb-4 text-center">
                <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" alt="City Icon">
            </div>
            <main class="pb-5">
                <div class="container">
                    <link rel="stylesheet" href="{{ asset('css/shop-acc-detail-custom.css') }}">
                    <div class="info-detail-product">
                        <div class="row info-line">
                            @foreach ($accountAttributes as $data)
                                <section class="col-md-4 col-12 text-uppercase text-center">
                                    <h4>{{ $data->GameAttribute->name }}</h4>
                                    <span>{{ $data->value }}</span>
                                </section>
                            @endforeach
                        </div>
                        <div class="hr-product"></div>
                        <div class="row info-line">
                            <section class="col-12 text-center">
                                <span class="more-detail" style="font-size: 17px">
                                    {{ $gameAccount->note }}
                                </span>
                            </section>
                        </div>
                        <div class="hr-product"></div>
                        @foreach ($accountItems as $data)
                            <div class="row info-line">
                                <section class="col-12 text-center">
                                    <h4 class="pb-2">{{ $data['type']->name }}</h4>
                                    @foreach ($data['items'] as $itemData)
                                        <span class="hero-details">
                                            <i class="hero-icon-detail" data-toggle="tooltip" style="background-image: url('{{ '/' . $itemData->image ?? 'null' }}')" onerror="this.src='https://fakeimg.pl/600x300'" title="{{ $itemData->name }}"></i>
                                        </span>
                                    @endforeach
                                </section>
                            </div>
                        @endforeach
                    </div>
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-6 col-12 text-center">
                            <a class="btn btn-pretty-detail my-3" href="https://www.youtube.com/feed/trending" target="_blank">
                                Xem Video
                            </a>
                            <a class="btn btn-pretty-detail my-3" href="{{ route('client.account-shop.buy-now', ['id' => $gameAccount->id]) }}">
                                Mua Ngay ({{ number_format($gameAccount->price_out) }} VND)
                            </a>
                        </div>
                    </div>
                    @if ($gameAccount->AccountImage->count() > 0)
                        <div class="row justify-content-center info-detail-product">
                            @foreach ($gameAccount->AccountImage ?? [] as $data)
                                <div class="col-12">
                                    @once
                                        <h1 class="title-shine h2 text-center">Hình ảnh chi tiết acc</h1>
                                        <p class="title-shine text-center" style="font-size: 17px">{{ $gameAccount->title }}</p>
                                    @endonce
                                    <img class="product-image" src="{{ asset($data->image) }}" alt="Ảnh acc Genshin" onerror="this.src='https://fakeimg.pl/600x300'" />
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </section>
@endsection
