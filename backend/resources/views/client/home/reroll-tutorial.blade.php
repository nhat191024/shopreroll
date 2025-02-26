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
                        <div class="col-md-12 tool-review row">
                            <div class="col-md-2 col-6 text-center" style="padding-right: 2px;padding-left: 2px;">
                                @foreach ($rerollSubCategoryPackages as $packet)

                                <form method="post" action="{{ route('client.reroll.detail.buy') }}">
                                    @csrf
                                    <input type="hidden" name="reroll_category_id" value="{{ $rerollSubCategory[0]->id }}">
                                    <input type="hidden" name="packet_id" value="{{ $packet->id }}">
                                    <button type="submit" name="submit"
                                    style="width: 100%;background: unset;border: unset;">
                                    <div class="small amount_key">
                                        còn
                                        1
                                    </div>
                                    <div class="tool-item">
                                        <div class="text-center">
                                            <i class="fa fa-cart-plus mr-1"></i> {{ $packet->name }}<br> <i
                                            class="fa fa-coins mr-1"></i> {{ $packet->price }}<sup></sup>
                                        </div>
                                    </div>
                                </button>

                            </form>
                            @endforeach

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 tool-review">
                                <div class="tool-review-bounder">
                                    <div class="col-xs-12 col-md-6 tool-download" style="padding-right: 0">
                                    </div>
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
            </main>
        </div>
    </section>
@endsection
