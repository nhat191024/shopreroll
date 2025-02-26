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
                    <div class="card card-solid offset-lg-1 col-lg-10">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="h h5 text-primary">Nhập thông tin
                                        yêu cầu nạp</div>
                                    <form method="post" action="{{ route('client.recharge.confirm') }}">
                                        @csrf
                                        <input name="game_recharge_id" value="{{ $gameRecharge->id }}" hidden>
                                        <div class="form-group">
                                            <label class="form-label">Game</label>
                                            <input class="form-control" value="{{ $gameRecharge->name }}" disabled="">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Gói
                                            </label>
                                            <select name="recharge_packet_id" class="form-control">
                                                @foreach ($rechargePackages as $rechargePackage)
                                                    <option
                                                        value="{{ $rechargePackage->id }}">
                                                        {{ number_format($rechargePackage->price) }} đ -
                                                        {{ $rechargePackage->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-lg-6 mt-2">
                                                <label>UID (User ID)</label>
                                                <div class="input-group row">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-pen-fancy"></i></span>
                                                    </div>
                                                    <input name="uid" type="text" class="form-control concave "
                                                        value="" placeholder="Điền UID
            ">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-2">
                                                <label> Tên đăng nhập
                                                </label>
                                                <div class="input-group row">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-pen-fancy"></i></span>
                                                    </div>
                                                    <input required="" name="login_name" type="text"
                                                        class="form-control concave " value=""
                                                        placeholder="Điền tên tài khoản
            ">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-2">
                                                <label>Mật khẩu
                                                </label>
                                                <div class="input-group row">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-pen-fancy"></i></span>
                                                    </div>
                                                    <input required="" name="pass" type="text"
                                                        class="form-control concave " value=""
                                                        placeholder="Điền mật khẩu tài khoản nạp
            ">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <label>Server</label>
                                                <div class="input-group row">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-pen-fancy"></i></span>
                                                    </div>
                                                    <input name="game_server" type="text" class="form-control concave "
                                                        value="" placeholder="Điền server
            ">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <label>Character name</label>
                                                <div class="input-group row">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-pen-fancy"></i></span>
                                                    </div>
                                                    <input name="character_name" type="text"
                                                        class="form-control concave " value=""
                                                        placeholder="Điền tên nhân vật">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <label>Số điện thoại
                                                </label>
                                                <div class="input-group row">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-pen-fancy"></i></span>
                                                    </div>
                                                    <input name="phone" type="text" class="form-control concave "
                                                        value="" placeholder="Điền số điện thoại
            ">
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mt-3">
                                                <label>Ghi chú</label>
                                                <div class="input-group row">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-pen-fancy"></i></span>
                                                    </div>
                                                    <input name="note" type="text" class="form-control concave "
                                                        value=""
                                                        placeholder="Bạn muốn bổ sung điều gì?
            ">
                                                </div>
                                            </div>
                                            <div class="col-6 offset-3 mt-3">
                                                <!-- Google reCaptcha -->
                                                {{-- TODO: ADD GOOGLE RECAPTCHA --}}
                                                <!-- End Google reCaptcha -->
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group mt-4 text-center">
                                                    <button type="submit" name="submit" value="submit"
                                                        class="btn btn-pretty">Yêu cầu nạp
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="h h5 text-primary">Hướng dẫn</div>
                                    {!! $gameRecharge->tutorial !!}
                                    <div class="h h6 text-primary">Video hướng dẫn
                                    </div>
                                    <iframe width="100%" height="360"
                                        src="https://www.youtube.com/embed/{{ $gameRecharge->id_youtube }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen=""></iframe>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mt-2 table-responsive">
                                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table id="example1" class="table table-striped dataTable no-footer dtr-inline" role="grid" aria-describedby="example1_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting sorting_desc">ID</th>
                                                                <th class="sorting">Status</th>
                                                                <th class="sorting">Username</th>
                                                                <th class="sorting">Package</th>
                                                                <th class="sorting">Server</th>
                                                                <th class="sorting">Note</th>
                                                                <th class="sorting">Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse($rechargeBills as $bill)
                                                            <tr>
                                                                <td>{{ $bill->id ?? 'N/A' }}</td>
                                                                <td>{{ $bill->status ?? 'N/A' }}</td>
                                                                <td>{{ $bill->username ?? 'N/A' }}</td>
                                                                <td>{{ $bill->RechargePackage->name ?? 'N/A' }}</td>
                                                                <td>{{ $bill->server ?? 'N/A' }}</td>
                                                                <td>{{ $bill->note ?? 'N/A' }}</td>
                                                                <td>{{ $bill->created_at ?? 'N/A' }}</td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="7" class="text-center">No data available</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <nav class="mt-2 float-right">

                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </main>
        </div>
    </section>
@endsection
