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
                    <div class="container-lg mb-3">
                        <div class="row mb-3">
                            <div class="col text-center">
                                <span class="mt-2">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
                                        <button class="btn-pretty">Hỗ Trợ</button>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" target="_blank" href="https://zalo.me/0386496488">
                                            <img src="style/images/icon/zalo.png" alt="zalo" style="max-width: 40px; height: auto; margin-bottom: -8px; margin-top: -8px;" loading="lazy">0386496488
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
                                        <a class="dropdown-item" target="_blank" href="https://shopreroll.com/user/money/phone-card/send-card">
                                            <i class="fas fa-money-check-alt mr-1"></i> Nạp Thẻ
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" target="_blank" href="https://shopreroll.com/user/money/auto-bank/info">
                                            <i class="fas fa-university mr-1"></i> Chuyển Khoản
                                        </a>
                                    </div>
                                </span>

                                <span class="mt-2">
                                    <a href="#recharge_service">
                                        <button class="btn-pretty">Nạp Game</button>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <section class="row banner-top p-1">
                            <div id="miu-carousel" class="col-12 col-lg-8 carousel slide p-0" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active" style="margin-bottom: -5px;">
                                        <iframe width="100%" height="470" src="https://www.youtube.com/embed/OizK-VT4aj8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                                            @foreach ([['name' => 'Keith sierra', 'amount' => '22,707,000'], ['name' => 'Nam', 'amount' => '13,282,600'], ['name' => 'Perawit', 'amount' => '11,111,275'], ['name' => 'cau vang', 'amount' => '6,250,000'], ['name' => 'Nguyễn Duy', 'amount' => '4,373,010'], ['name' => 'Vo phuc khang', 'amount' => '4,310,000'], ['name' => 'Dương Quang Ánh', 'amount' => '4,270,000'], ['name' => 'bac', 'amount' => '4,218,520'], ['name' => 'Nguyễn minh Quang', 'amount' => '3,940,002'], ['name' => 'Nguyễn Văn Trường', 'amount' => '3,573,000']] as $index => $user)
                                                <li class="nav-link w-100" style="padding: .1rem 1rem">
                                                    <div class="row">
                                                        <div class="col-7 text-left" style="text-align: left; padding-left: 30px;">
                                                            <span class="fa-stack">
                                                                <span class="fa fa-circle fa-stack-2x"></span>
                                                                <strong class="fa-stack-1x" style="color: #000;">{{ $index + 1 }}</strong>
                                                            </span>
                                                            {{ $user['name'] }}
                                                        </div>
                                                        <div class="col-5">
                                                            <label class="btn btn-warning float-right mr-4" style="background-color:#ffeaaa; padding: .145rem .7rem; font-weight: 600;">
                                                                {{ $user['amount'] }}<sup></sup>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
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
                                            <a href="#">
                                                <img src="{{ asset($rerollCategory->image) }}" style="height: 350px; object-fit: contain;" loading="lazy">
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

                    <center>
                        <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20210717/2021071716211547763.png" loading="lazy">
                    </center>
                    <h2 id="recharge_service" class="guide__title">NẠP GAMES</h2>

                    <div class="container-lg">
                        <div class="row justify-content-center">
                            @foreach ($gameRecharges as $gameRecharge)
                                <article class="col-lg-3 col-sm-6 col-6 col-6 item-bounder">
                                    <center>
                                        <a href="{{ route('client.recharge', $gameRecharge->id) }}">
                                            <img class="item-image-key" src="{{ asset($gameRecharge->image) }}" loading="lazy">
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
