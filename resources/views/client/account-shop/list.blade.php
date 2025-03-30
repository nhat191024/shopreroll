@extends('client.layouts.master')

@section('main')
<link rel="stylesheet" href="{{ asset('css/shop-acc-list-custom.css') }}">
    <section class="content">
        <div class="container-fluid">
            <center><img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png"
                    onerror="this.src='https://placehold.co/600x600'" class="city__icon"></center>
            <h1 class="guide__title"> Acc {{ $title }} </h1>
            <main>
                <div>
                    <div class="container-lg">
                        <div class="row">
                            <div class="col-12 col-lg-3 search-zone">
                                <section id="search-form" class="search-frm p-4 pb-5">
                                    <p class="text-center ms-text h5 m-2">Tìm kiếm
                                    </p>
                                    <p class="text-center small">Bỏ trống tùy ý
                                    </p>
                                    <form method="get" action="#">
                                        @csrf
                                        <div class="col-12 mt-3">
                                            <label class="form-label">Giá
                                            </label>
                                            <select class="form-control select2 select2-hidden-accessible" name="price"
                                                data-select2-id="5" tabindex="-1" aria-hidden="true">
                                                <option value="" data-select2-id="7">Chọn giá
                                                </option>
                                                <option value="1|10000">10k trở xuống
                                                </option>
                                                <option value="10000|50000">10K - 50K</option>
                                                <option value="50000|100000">50K - 100K</option>
                                                <option value="100000|200000">100K - 200K</option>
                                                <option value="200000|300000">200K - 300K</option>
                                                <option value="300000|400000">300K - 400K</option>
                                                <option value="400000|500000">400K - 500K</option>
                                                <option value="500000|800000">500K - 800K</option>
                                                <option value="800000|1000000">800K - 1tr</option>
                                                <option value="1000000|2000000">1tr - 2tr</option>
                                                <option value="2000000|3000000">2tr - 3tr</option>
                                                <option value="3000000|4000000">3tr - 4tr</option>
                                                <option value="4000000|5000000">4tr - 5tr</option>
                                                <option value="5000000|6000000">5tr - 6tr</option>
                                                <option value="6000000|7000000">6tr - 7tr</option>
                                                <option value="7000000|8000000">7tr - 8tr</option>
                                                <option value="8000000|9000000">8tr - 9tr</option>
                                                <option value="9000000|10000000">9tr - 10tr</option>
                                                <option value="10000000|12000000">10tr - 12tr</option>
                                                <option value="12000000|15000000">12tr - 15tr</option>
                                                <option value="15000000|20000000">15tr - 20tr</option>
                                                <option value="20000000|25000000">20tr - 25tr</option>
                                                <option value="25000000|30000000">25tr - 30tr</option>
                                                <option value="30000000|999999999">Trên
                                                    30tr</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <label class="form-label">Sắp xếp giá
                                                </label>
                                                <select class="form-control" name="sort_price">
                                                    <option value="asc">Tăng dần
                                                    </option>
                                                    <option value="desc">Giảm dần
                                                    </option>
                                                </select>
                                            </div>
                                            
                                        </div>

                                        <div class="col-12 mt-3">
                                            <button name="search" value="search" type="submit"
                                                class="offset-2 col-8 form-control btn btn-warning text-white font-weight-bold"><i
                                                    class="fab fa-searchengin ml-2"></i> Tìm kiếm
                                            </button>
                                        </div>
                                    </form>
                                </section>
                            </div>

                            <div class="col-lg-9 product-list mt-4 mt-lg-0">
                                <div class="row">

                                    @foreach ($gameAccounts as $data)
                                        <article class="col-md-6 col-lg-4">
                                            <div class="genshin-product">
                                                <div class="product-code">#{{ $data->id }}</div>
                                                <div class="wrapper product-wrapper">
                                                    <a
                                                        href="{{route('client.game.account.detail', $data->id)}}">
                                                        <img class="img-banner shadow-sm"
                                                            src="{{ asset($data->image) }}" 
                                                            onerror="this.src='https://placehold.co/600x600'">
                                                    </a>

                                                    <div class="row mt-1">
                                                        <div class="col-6">
                                                            <div class="btn btn-warning font-weight-bold">
                                                                <span class="text-danger">{{ number_format($data->price_out) }}<sup></sup></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="btn btn-secondary" style="margin-right: 12px;">
                                                                <s>{{ number_format($data->price_out * 1.15) }}</s><sup></sup>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row g-0 info-line">
                                                        @foreach ($data->AccountAttribute as $accountAttribute)
                                                            <section class="col text-center"><label>{{ $accountAttribute->GameAttribute->name }}</label> {{ $accountAttribute->value }}
                                                            </section>
                                                        @endforeach
                                                    </div>
                                                    <div class="hr-product"></div>
                                                    <div class="row g-0 info-line">
                                                        <section class="row g-0 text-center">
                                                            <span class="more-detail">{{ $data->title }}</span>
                                                        </section>
                                                    </div>
                                                    <div class="hr-product"></div>

                                                    @php
                                                        $accountItems = $data->AccountItem
                                                            ->groupBy(function($item) {
                                                                return $item->GameItem->gameItemType->id;
                                                            })
                                                            ->map(function($items, $typeId) {
                                                                return [
                                                                    'type' => \App\Models\GameItemType::find($typeId),
                                                                    'items' => $items->map(function($item) {
                                                                        return $item->GameItem;
                                                                    })
                                                                ];
                                                            });
                                                    @endphp             
                                                    @foreach($accountItems as $items)
                                                        <div class="row g-0 info-line">
                                                            <section class="row g-0 text-center">
                                                                <label class="col-12 pb-2">{{ $items['type']->name }} : {{ $items['items']->count() }}</label>
                                                                <span class="col hero-details">
                                                                    @foreach ($items['items'] as $itemData)
                                                                        <i class="hero-icon"
                                                                            style="background-image: url('{{ '/'.$itemData->image ?? 'null' }}')"
                                                                            data-toggle="tooltip" title="{{ $itemData->title }}"
                                                                            onerror="this.src='https://placehold.co/600x300'"
                                                                            data-original-title="Alhaitham">
                                                                        </i>
                                                                    @endforeach
                                                                </span>
                                                            </section>
                                                        </div>
                                                    @endforeach

                                                    
                                                    <div class="row g-0">
                                                        <a href="{{ route('client.game.account.detail', $data->id) }}"
                                                            class="btn btn-primary product-detail-button mb-4">Chi tiết
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach

                                </div>
                                @if ($gameAccounts->count() > 0)
                                    <nav class="mt-4 float-right">
                                        {{ $gameAccounts->links() }}
                                    </nav>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>

    </section>
@endsection
