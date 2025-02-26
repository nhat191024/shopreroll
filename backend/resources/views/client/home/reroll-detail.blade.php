@extends('client.layouts.master')

@section('main')
    <section class="content">
        <div class="container-fluid">
            <div class="text-center">
                <img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" class="city__icon"
                    loading="lazy">
            </div>
            <h1 class="guide__title">Shop bán acc Honkai Star Rail và Genshin uy tín hàng đầu Việt Nam</h1>
            <main>
                <div>

                    <div class="container-lg">
                        <div class="row item-container">
{{--
                            @foreach ($rerollSubCategory as $data)
                                <div class="col-md-3">
                                    <div class="item-bounder">
                                        <div class="item-image-key">
                                            <a href="#">
                                                <img src="{{ url('image/thumb') . '/' . $data->image }}" alt="..."
                                                    loading="lazy">
                                            </a>
                                        </div>
                                        <div>
                                            <h3 class="text-center title_cate mt-3">{{ $data->name }}</h3>
                                            <a href="{{ route('client.reroll.detail', ['id' => $data->id]) }}">
                                                <button class="btn btn_left">
                                                    Mua Ngay
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
--}}
                            @foreach ($rerollSubCategory as $data)
                            <div class="col-md-3">
                                <div class="item-bounder">
                                    <div class="item-image-key">
                                        <a href="{{ route('client.reroll.detail.tutorial', ['id' => $data->id]) }}"><img
                                                src="{{ url('image/thumb') . '/' . $data->image }}"
                                                alt="..."></a>
                                    </div>
                                    <div class="item-caption">
                                        <h3 class="text-center title_cate">{{ $data->name }}</h3>
                                        <hr>
                                        <form method="post" action="{{ route('client.reroll.detail.buy') }}" class="row">
                                            @csrf
                                            <input type="hidden" name="reroll_sub_category_id" value="{{ $data->id }}">
                                            <div class="col-5" style="padding-right: 3.5px;padding-left: 3.5px;">
                                                <select required="" name="packet_id" class="form-control"
                                                    id="package_list_{{ $data->id }}">
                                                    <option value="">Chọn gói</option>
                                                    {{-- <option value="74">8,000 / Main Random</option> --}}
                                                    @foreach ($data->RerollPackage as $packet)
                                                        <option value="{{ $packet->id }}">{{ $packet->price }} /
                                                            {{ $packet->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2" data-toggle="tooltip" title=""
                                                style="padding-right: 3.5px;padding-left: 3.5px;"
                                                data-original-title="Số lượng">
                                                <input name="amount" type="number" value="1" class="form-control" min="1"
                                                    style="padding: 0.375rem 0.6rem;" required="">
                                            </div>
                                            <div class="col-5" style="padding-right: 3.5px;padding-left: 3.5px;">
                                                <button type="submit" class="buy-now btn btn-primary"
                                                    style="width: 100%">Mua ngay
                                                </button>
                                            </div>
                                        </form>
                                        <div style="height: 10px"></div>
                                        <div class="col-md-12">
                                            <a href="{{ route('client.reroll.detail.tutorial', ['id' => $data->id]) }}"
                                                class="btn btn_left btn_down_guide" role="button"><i
                                                    class="fa fa-photo-video mr-1"></i>TUTORIAL</a>
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
