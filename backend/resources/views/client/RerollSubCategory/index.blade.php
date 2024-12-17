@extends('client.layouts.master')

@section('main')
    <center><img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" class="city__icon">
    </center>
    <h1 class="guide__title"> ACC Zenless Zone Zero
    </h1>
    <main>
        <div>
            <div class="container-lg">
                <div class="header-notice mb-3 text-center bg-light p-3">
                    <span class="font-weight-bold" style="font-size: 30px;">
                        <a href="https://www.facebook.com/groups/683984232814675/posts/1152302775982816/" target="_blank">HỖ
                            TRỢ
                            Zenless Zone Zero - </a>
                        <a href="https://www.facebook.com/dat.ds.3/posts/pfbid02pfH2cpyeXNG9hvPQmhEHaSTi82fWTzsMpQBHdJQ46QDAhKPyNiud2V1G1yQAsPLpl?rdid=Ja42mt0OVd8OjLl3"
                            target="_blank">Hỏi/Đáp</a>
                    </span>
                    <span class="font-weight-bold" style="font-size: 30px;">
                        <a href="https://www.facebook.com/dat.ds.3/posts/pfbid02pfH2cpyeXNG9hvPQmhEHaSTi82fWTzsMpQBHdJQ46QDAhKPyNiud2V1G1yQAsPLpl?rdid=Ja42mt0OVd8OjLl3"
                            target="_blank">☞ Bấm Đây</a>
                    </span>
                </div>
                <div class="header-notice mb-3 text-center bg-light p-3">
                    <span class="font-weight-bold" style="font-size: 30px;">
                        <a href="https://outlook.live.com/mail/0/" target="_blank">Lẫy Mã Tại:
                            https://outlook.live.com/mail</a>
                    </span>
                </div>
                <div class="header-notice mb-3 text-center bg-light p-3">
                    <span class="font-weight-bold" style="font-size: 30px;">
                        <a href="https://www.facebook.com/groups/683984232814675/posts/1152302775982816/"
                            target="_blank">Tài
                            Khoản Mail cần unlock miễn phí liên hệ hỗ trợ</a>
                        <a href="https://www.facebook.com/dat.ds.3/posts/pfbid02pfH2cpyeXNG9hvPQmhEHaSTi82fWTzsMpQBHdJQ46QDAhKPyNiud2V1G1yQAsPLpl?rdid=Ja42mt0OVd8OjLl3"
                            target="_blank">☞ Bấm Đây</a>
                    </span>
                </div>
                <div class="row item-container">
                    @foreach ($subCategories as $item)
                        <div class="col-md-3">
                            <div class="item-bounder">
                                <div class="item-image-key">
                                    <a href="https://shopreroll.com/key/cate/guide/reroll-cap-4-main-random"><img
                                            {{-- ảnh sub-category --}} src="{{ url('image/thumb') . '/' . $item->image }}"
                                            alt="..."></a>
                                </div>
                                <div class="item-caption">
                                    <h3 class="text-center title_cate">{{ $item->name }}</h3>
                                    <hr>
                                    <form method="post" action="https://shopreroll.com/key/key/buy" class="row">
                                        <input type="hidden" name="_token"
                                            value="D522lw23QpBcwDgw9hZuMIEsn6gkQspHhQ6SzgG0">
                                        <div class="col-5" style="padding-right: 3.5px;padding-left: 3.5px;">
                                            <select required name="packet_id" class="form-control" id="package_list_18">
                                                <option value="">Select package</option>
                                                @foreach ($item->rerollPackages as $package)
                                                    <option value="{{ $package->id }}">{{ $package->price }} /
                                                        {{ $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2" data-toggle="tooltip" title="Số lượng"
                                            style="padding-right: 3.5px;padding-left: 3.5px;">
                                            <input name="amount" type="number" value="1" class="form-control"
                                                style="padding: 0.375rem 0.6rem;" required>
                                        </div>
                                        <div class="col-5" style="background-color: #008b88; border-color: #008b88;">
                                            <button type="submit" name="submit" class="buy-now btn"
                                                style="width: 100% ">Mua ngay
                                            </button>
                                        </div>
                                    </form>
                                    <div class="col-md-12 mt-3 mb-4">
                                        <a href="https://shopreroll.com/key/cate/guide/reroll-cap-4-main-random"
                                            class="btn" style="background-color: #8a6232; border-color: #805828;"
                                            role="button"><i class="fa fa-photo-video mr-1"></i> DOWNLOAD &amp;
                                            TUTORIAL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
