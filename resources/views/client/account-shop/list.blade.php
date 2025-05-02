@extends('client.layouts.master')

@section('main')
    <link rel="stylesheet" href="{{ asset('css/shop-acc-list-custom.css') }}">
    <section class="content">
        <div class="container-fluid">
            <center><img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" onerror="this.src='https://fakeimg.pl/600x600'"></center>
            <h1 class="guide__title"> Acc {{ $title }} </h1>
            <main>
                <div>
                    <div class="container-lg">
                        <div class="row">
                            <div class="col-12 col-lg-3 search-zone">
                                <section id="search-form" class="search-frm p-4 pb-5">
                                    <p class="ms-text h5 m-2 text-center">Tìm kiếm</p>
                                    <p class="small text-center">Bỏ trống tùy ý</p>
                                    <form method="get" action="{{ route('client.game.account.category', ['gameId' => $gameId, 'categoryId' => $categoryId]) }}">
                                        @foreach ($gameAttributes as $gameAttribute)
                                            <div class="col-12 mt-3">
                                                <label class="form-label">{{ $gameAttribute->name }}</label>
                                                <select class="form-control select2" name="attributes[]" data-placeholder="Select {{ $gameAttribute->name }}" multiple="multiple">
                                                    @foreach ($gameAttribute->accountAttributes->unique('value') as $accountAttribute)
                                                        <option value="{{ $accountAttribute->id }}" {{ in_array($accountAttribute->id, old('attributes', [])) ? 'selected' : '' }}>
                                                            {{ $accountAttribute->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach

                                        @foreach ($gameItemTypes as $gameItemType)
                                            <div class="col-12 mt-3">
                                                <label class="form-label">{{ $gameItemType->name }}</label>
                                                <select class="form-control select2" name="game_items[]" data-placeholder="Select {{ $gameItemType->name }}" multiple="multiple">
                                                    @foreach ($gameItemType->gameItems->unique('name') as $accountAttribute)
                                                        <option value="{{ $accountAttribute->id }}" {{ in_array($accountAttribute->id, old('game_items', [])) ? 'selected' : '' }}>
                                                            {{ $accountAttribute->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach

                                        <div class="col-12 mt-3">
                                            <label class="form-label">Giá</label>
                                            <select id="price-select" class="form-control select2" name="price">
                                                <option value="">Chọn giá</option>
                                                <option value="1|10000" {{ old('price') == '1|10000' ? 'selected' : '' }}>
                                                    10k trở xuống</option>
                                                <option value="10000|50000" {{ old('price') == '10000|50000' ? 'selected' : '' }}>10K - 50K
                                                </option>
                                                <option value="50000|100000" {{ old('price') == '50000|100000' ? 'selected' : '' }}>50K - 100K
                                                </option>
                                                <option value="100000|200000" {{ old('price') == '100000|200000' ? 'selected' : '' }}>100K - 200K
                                                </option>
                                                <option value="200000|300000" {{ old('price') == '200000|300000' ? 'selected' : '' }}>200K - 300K
                                                </option>
                                                <option value="300000|400000" {{ old('price') == '300000|400000' ? 'selected' : '' }}>300K - 400K
                                                </option>
                                                <option value="400000|500000" {{ old('price') == '400000|500000' ? 'selected' : '' }}>400K - 500K
                                                </option>
                                                <option value="500000|800000" {{ old('price') == '500000|800000' ? 'selected' : '' }}>500K - 800K
                                                </option>
                                                <option value="800000|1000000" {{ old('price') == '800000|1000000' ? 'selected' : '' }}>800K - 1tr
                                                </option>
                                                <option value="1000000|2000000" {{ old('price') == '1000000|2000000' ? 'selected' : '' }}>1tr - 2tr
                                                </option>
                                                <option value="2000000|3000000" {{ old('price') == '2000000|3000000' ? 'selected' : '' }}>2tr - 3tr
                                                </option>
                                                <option value="3000000|4000000" {{ old('price') == '3000000|4000000' ? 'selected' : '' }}>3tr - 4tr
                                                </option>
                                                <option value="4000000|5000000" {{ old('price') == '4000000|5000000' ? 'selected' : '' }}>4tr - 5tr
                                                </option>
                                                <option value="5000000|6000000" {{ old('price') == '5000000|6000000' ? 'selected' : '' }}>5tr - 6tr
                                                </option>
                                                <option value="6000000|7000000" {{ old('price') == '6000000|7000000' ? 'selected' : '' }}>6tr - 7tr
                                                </option>
                                                <option value="7000000|8000000" {{ old('price') == '7000000|8000000' ? 'selected' : '' }}>7tr - 8tr
                                                </option>
                                                <option value="8000000|9000000" {{ old('price') == '8000000|9000000' ? 'selected' : '' }}>8tr - 9tr
                                                </option>
                                                <option value="9000000|10000000" {{ old('price') == '9000000|10000000' ? 'selected' : '' }}>9tr - 10tr
                                                </option>
                                                <option value="10000000|12000000" {{ old('price') == '10000000|12000000' ? 'selected' : '' }}>10tr - 12tr
                                                </option>
                                                <option value="12000000|15000000" {{ old('price') == '12000000|15000000' ? 'selected' : '' }}>12tr - 15tr
                                                </option>
                                                <option value="15000000|20000000" {{ old('price') == '15000000|20000000' ? 'selected' : '' }}>15tr - 20tr
                                                </option>
                                                <option value="20000000|25000000" {{ old('price') == '20000000|25000000' ? 'selected' : '' }}>20tr - 25tr
                                                </option>
                                                <option value="25000000|30000000" {{ old('price') == '25000000|30000000' ? 'selected' : '' }}>25tr - 30tr
                                                </option>
                                                <option value="30000000|999999999" {{ old('price') == '30000000|999999999' ? 'selected' : '' }}>Trên 30tr
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label">Sắp xếp giá</label>
                                            <select class="form-control select2" name="sort_price">
                                                <option value="asc" {{ old('sort_price') == 'asc' ? 'selected' : '' }}>
                                                    Tăng dần</option>
                                                <option value="desc" {{ old('sort_price') == 'desc' ? 'selected' : '' }}>
                                                    Giảm dần</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="form-label" for="inpSearchHero">Mã số
                                            </label>
                                            <input class="form-control" name="acc_id" type="number" value="{{ old('acc_id') }}" placeholder="Điền mã số acc">
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="row">
                                                <div class="col-{{ $search ? '6' : '12' }}">
                                                    <button class="form-control btn btn-warning font-weight-bold text-white" name="search" type="submit" value="search">
                                                        <i class="fab fa-searchengin mr-2"></i> Tìm
                                                        {{ $search ? '' : 'kiếm' }}
                                                    </button>
                                                </div>
                                                @if ($search)
                                                    <div class="col-6">
                                                        <a class="form-control btn btn-secondary font-weight-bold text-white" name="clear" type="button" value="clear" href="{{ route('client.game.account.category', ['gameId' => $gameId, 'categoryId' => $categoryId]) }}">
                                                            <i class="fas fa-times mr-2"></i> Reset
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </section>
                            </div>

                            <div class="col-lg-9 product-list mt-lg-0 mt-4">
                                <div class="row">
                                    @foreach ($gameAccounts as $data)
                                        <article class="col-md-6 col-lg-4">
                                            <div class="genshin-product">
                                                <div class="product-code">#{{ $data->id }}</div>
                                                <div class="wrapper product-wrapper">
                                                    <a href="{{ route('client.game.account.detail', $data->id) }}">
                                                        <img class="img-banner shadow-sm" src="{{ asset($data->AccountImage??$data->AccountImage->first()->image) }}" onerror="this.src='https://fakeimg.pl/600x600'">
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
                                                            <section class="col text-center">
                                                                <label>{{ $accountAttribute->GameAttribute->name }}</label>
                                                                {{ $accountAttribute->value }}
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
                                                            ->groupBy(function ($item) {
                                                                return $item->GameItem->gameItemType->id;
                                                            })
                                                            ->map(function ($items, $typeId) {
                                                                return [
                                                                    'type' => \App\Models\GameItemType::find($typeId),
                                                                    'items' => $items->map(function ($item) {
                                                                        return $item->GameItem;
                                                                    }),
                                                                ];
                                                            });
                                                    @endphp
                                                    @foreach ($accountItems as $items)
                                                        <div class="row g-0 info-line">
                                                            <section class="row g-0 text-center">
                                                                <label class="col-12 pb-2">{{ $items['type']->name }} :
                                                                    {{ $items['items']->count() }}</label>
                                                                <span class="col hero-details">
                                                                    @foreach ($items['items'] as $itemData)
                                                                        <i class="hero-icon" data-toggle="tooltip" data-original-title="Alhaitham" style="background-image: url('{{ '/' . $itemData->image ?? 'null' }}')" title="{{ $itemData->title }}" onerror="this.src='https://fakeimg.pl/600x300'">
                                                                        </i>
                                                                    @endforeach
                                                                </span>
                                                            </section>
                                                        </div>
                                                    @endforeach

                                                    <div class="row g-0">
                                                        <a class="btn btn-primary product-detail-button mb-4" href="{{ route('client.game.account.detail', $data->id) }}">Chi tiết
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach

                                </div>
                                @if ($gameAccounts->count() > 0)
                                    <nav class="float-right mt-4">
                                        @if (method_exists($gameAccounts, 'links'))
                                            {{ $gameAccounts->links() }}
                                        @endif
                                    </nav>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </section>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                allowClear: true,
                searchable: true,
                minimumResultsForSearch: 5
            });
        });
    </script>
@endsection
