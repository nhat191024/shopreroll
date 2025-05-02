@extends('client.layouts.master')

@section('main')
    <link rel="stylesheet" href="{{ asset('css/home-custom.css') }}">
    <section class="content">
        <div class="container-fluid">
            <div class="text-center">
                <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" onerror="this.src='https://placehold.co/600x600'" loading="lazy">
            </div>
            <h1 class="guide__title px-5">Shop bán acc Honkai Star Rail và Genshin uy tín hàng đầu Việt Nam</h1>
            <main>
                <div>
                    <div class="container-lg mb-3">
                        <div class="row mb-3">
                            <div class="col text-center">
                                <span class="mt-2">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn-pretty">Hỗ Trợ</button>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" target="_blank" href="https://zalo.me/0386496488">
                                            <img src="{{ asset('/image/thumb/zalo.png') }}" onerror="this.src='https://placehold.co/600x600'" alt="zalo" style="max-width: 40px; height: auto; margin-bottom: -8px; margin-top: -8px;" loading="lazy">0386496488
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" target="_blank" href="https://www.facebook.com/dat.ds.3">
                                            <span style="background-color: #1877f2; border-radius: 4px; padding: 4px 8px 4px 8px;">
                                                <i class="fab fa-facebook-f fa-lg" style="color: white"></i>
                                            </span> Facebook
                                        </a>
                                    </div>
                                </span>

                                <span class="mt-2">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn-pretty">Nạp Tiền</button>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('client.user.topup.card') }}">
                                            <i class="fas fa-money-check-alt mr-1"></i> Nạp Thẻ
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('client.user.topup.bank') }}">
                                            <i class="fas fa-university mr-1"></i> Chuyển Khoản
                                        </a>
                                    </div>
                                </span>

                                <span class="mt-2">
                                    <a href="{{ route('client.home') }}#recharge_service">
                                        <button class="btn-pretty">Nạp Game</button>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <section class="row banner-top p-1">
                            <div id="miu-carousel" class="col-12 col-lg-8 carousel slide p-0" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active" style="margin-bottom: -5px;">
                                        <iframe width="100%" onerror="this.src='https://placehold.co/600x600'" height="470" src="https://www.youtube.com/embed/LmmfXWOvSU0?si=vxNIin1ImvaFpweu" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                            <div id="top_user" class="col-12 col-lg-4 p-0">
                                <ul id="MiuTopTab" class="nav nav-tabs mb-2" role="tablist">
                                    <li class="nav-item col" role="presentation">
                                        <a id="top-tab" class="nav-link text-uppercase text-center" data-bs-toggle="tab" href="#toptab" role="tab" aria-controls="profile" aria-selected="false">
                                            Top nạp tiền
                                        </a>
                                    </li>
                                </ul>
                                <div id="nav-user" class="tab-content">
                                    <div id="toptab" class="tab-pane fade show active" role="tabpanel" aria-labelledby="toptab">
                                        <ul class="nav nav-user">
                                            @forelse ($topUpRanking as $index => $user)
                                                <li class="nav-link w-100" style="padding: .1rem 1rem">
                                                    <div class="row">
                                                        <div class="col-7 text-truncate text-left" style="text-align: left; padding-left: 30px;">
                                                            <span class="fa-stack">
                                                                <span class="fa fa-circle fa-stack-2x"></span>
                                                                <strong class="fa-stack-1x" style="color: #000;">{{ $index + 1 }}</strong>
                                                            </span>
                                                            <span>{{ $user['name'] ?? 'Unknown' }}</span>
                                                        </div>
                                                        <div class="col-5">
                                                            <label class="btn btn-warning float-right mr-4" style="background-color:#ffeaaa; padding: .145rem .7rem; font-weight: 600;">
                                                                {{ $user['amount'] ?? '0' }}<sup></sup>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="nav-link w-100 text-center">Chưa có dữ liệu</li>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div id="anoumentTab" class="tab-pane fade" role="tabpanel" aria-labelledby="bounustab" style="padding: 10px;">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="container-lg">
                        <div class="row item-container">
                            @foreach ($rerollCategories as $rerollCategory)
                                <div class="col-md-3">
                                    <div class="item-bounder">
                                        <div class="item-image-key">
                                            <a href="{{ route('client.reroll.detail', ['id' => $rerollCategory->id]) }}">
                                                <div class="square-image-container">
                                                    <img class="square-image" src="{{ asset($rerollCategory->image) }}" onerror="this.src='https://placehold.co/300x300'" loading="lazy">
                                                </div>
                                            </a>
                                        </div>
                                        <div>
                                            <h3 class="title_cate mt-3 text-center">{{ $rerollCategory->name }}</h3>
                                            <a href="{{ route('client.reroll.detail', ['id' => $rerollCategory->id]) }}">
                                                <button class="btn btn_left">
                                                    Mua Ngay
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @foreach ($gameAccountCategories as $game)
                        @if ($game->GameCategory->count() == 0)
                            @continue
                        @endif
                        <center>
                            <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20210717/2021071716211547763.png" onerror="this.src='https://placehold.co/600x600'" loading="lazy">
                        </center>
                        <h2 class="guide__title">Acc {{ $game->name }}</h2>

                        <div class="container-lg">
                            <div class="row justify-content-center">
                                @foreach ($game->GameCategory as $category)
                                    <article class="col-12 col-sm-6 col-lg-3 item-bounder">
                                        <center>
                                            <a href="{{ route('client.game.account.category', ['gameId' => $game->id, 'categoryId' => $category->id]) }}">
                                                <div class="game-img-outer">
                                                    <div class="game-img-box">
                                                        <img class="game-img-content" src="{{ asset($category->image) }}" onerror="this.src='https://placehold.co/600x600'" loading="lazy">
                                                    </div>
                                                </div>
                                            </a>
                                            <h2 class="note__title">{{ $category->name }}</h2>
                                            <div class="row g-0 info-line">
                                                <section class="row g-0 text-center">
                                                    <label class="text-muted">Số tài khoản</label>
                                                    <span class="more-detail fs-4">{{ $category->GameAccount ? $category->GameAccount->where('status', 1)->count() : 0 }}</span>
                                                </section>
                                            </div>
                                            <div class="row g-0 info-line">
                                                <section class="row g-0 text-center">
                                                    <label class="text-muted">Đã bán</label>
                                                    <span class="more-detail fs-4">{{ $category->GameAccount && $category->GameAccount->count() > 0 ? ($category->GameAccount->first()->AccountBill ? $category->GameAccount->first()->AccountBill->where('status', 1)->count() : 0) : 0 }}</span>
                                                </section>
                                            </div>
                                            <a href="{{ route('client.game.account.category', ['gameId' => $game->id, 'categoryId' => $category->id]) }}">
                                                <button class="btn-pretty mb-4 mt-2">Khám phá</button>
                                            </a>
                                        </center>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <center>
                        <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20210717/2021071716211547763.png" onerror="this.src='https://placehold.co/600x600'" loading="lazy">
                    </center>
                    <h2 id="recharge_service" class="guide__title">NẠP GAMES</h2>

                    <div class="container-lg">
                        <div class="row justify-content-center">
                            @foreach ($gameRecharges as $gameRecharge)
                                <article class="col-12 col-sm-6 col-lg-3 item-bounder">
                                    <center>
                                        <a href="{{ route('client.recharge', $gameRecharge->id) }}">
                                            <div class="game-img-outer">
                                                <div class="game-img-box">
                                                    <img class="game-img-content" src="{{ asset($gameRecharge->image) }}" onerror="this.src='https://placehold.co/600x600'" loading="lazy">
                                                </div>
                                            </div>
                                        </a>
                                        <h2 class="note__title">{{ $gameRecharge->name }}</h2>
                                        <div class="row g-0 info-line">
                                            <section class="row g-0 text-center">
                                                <label class="text-muted">Đang nạp</label>
                                                <span class="more-detail fs-4">0</span>
                                            </section>
                                        </div>
                                        <div class="row g-0 info-line">
                                            <section class="row g-0 text-center">
                                                <label class="text-muted">Đã nạp</label>
                                                <span class="more-detail fs-4">16</span>
                                            </section>
                                        </div>
                                        <a href="{{ route('client.recharge', $gameRecharge->id) }}">
                                            <button class="btn-pretty mb-4 mt-2">Nạp Ngay</button>
                                        </a>
                                    </center>
                                </article>
                            @endforeach
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </section>
@endsection
