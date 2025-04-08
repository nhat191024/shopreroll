@extends('client.layouts.master')

@section('main')
    <style>
        #recharge-history-table th,
        #recharge-history-table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>

    <div class="container-fluid">
        <div class="text-center">
            <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" loading="lazy">
        </div>
        <h1 class="guide__title">Shop bán acc Honkai Star Rail và Genshin uy tín hàng đầu Việt Nam</h1>
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
                                    <select class="form-control" name="recharge_packet_id">
                                        @foreach ($rechargePackages as $rechargePackage)
                                            <option value="{{ $rechargePackage->id }}">
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
                                                <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                                            </div>
                                            <input class="form-control concave" name="uid" type="text" value="" placeholder="Điền UID">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-2">
                                        <label> Tên đăng nhập
                                        </label>
                                        <div class="input-group row">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                                            </div>
                                            <input class="form-control concave" name="login_name" type="text" required="" value="" placeholder="Điền tên tài khoản">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-2">
                                        <label>Mật khẩu
                                        </label>
                                        <div class="input-group row">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                                            </div>
                                            <input class="form-control concave" name="pass" type="text" required="" value="" placeholder="Điền mật khẩu tài khoản nạp">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <label>Server</label>
                                        <div class="input-group row">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                                            </div>
                                            <input class="form-control concave" name="game_server" type="text" value="" placeholder="Điền server">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <label>Character name</label>
                                        <div class="input-group row">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                                            </div>
                                            <input class="form-control concave" name="character_name" type="text" value="" placeholder="Điền tên nhân vật">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <label>Số điện thoại
                                        </label>
                                        <div class="input-group row">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                                            </div>
                                            <input class="form-control concave" name="phone" type="text" value="" placeholder="Điền số điện thoại">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mt-3">
                                        <label>Ghi chú</label>
                                        <div class="input-group row">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                                            </div>
                                            <input class="form-control concave" name="note" type="text" value="" placeholder="Bạn muốn bổ sung điều gì?">
                                        </div>
                                    </div>
                                    <div class="col-6 offset-3 mt-3">
                                        <!-- Google reCaptcha -->
                                        {{-- TODO: ADD GOOGLE RECAPTCHA --}}
                                        <!-- End Google reCaptcha -->
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mt-4 text-center">
                                            <button class="btn btn-pretty" name="submit" type="submit" value="submit">Yêu cầu nạp
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
                            <iframe width="100%" height="360" src="https://www.youtube.com/embed/{{ $gameRecharge->id_youtube }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="">
                            </iframe>
                        </div>
                        <div class="col-lg-12">
                            <div class="table-responsive mt-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="recharge-history-table" class="table-striped table-bordered table" style="width:100%">
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
                                                @foreach ($rechargeBills as $bill)
                                                    <tr>
                                                        <td>{{ $bill->id ?? 'N/A' }}</td>
                                                        <td>{{ $bill->status == 0 ? 'Chưa thanh toán' : 'Đã thanh toán' }}
                                                        </td>
                                                        <td>{{ $bill->username ?? 'N/A' }}</td>
                                                        <td>{{ $bill->RechargePackage->name ?? 'N/A' }}</td>
                                                        <td>{{ $bill->server ?? 'N/A' }}</td>
                                                        <td>{{ $bill->note ?? 'N/A' }}</td>
                                                        <td>{{ $bill->created_at ?? 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <th class="sorting sorting_desc">ID</th>
                                                <th class="sorting">Status</th>
                                                <th class="sorting">Username</th>
                                                <th class="sorting">Package</th>
                                                <th class="sorting">Server</th>
                                                <th class="sorting">Note</th>
                                                <th class="sorting">Time</th>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable with all buttons explicitly
            const table = $("#recharge-history-table").DataTable({
                pageLength: 4,
                dom: "<'row'<'col-sm-12 col-md-10 mb-2'B><'col-sm-12 col-md-2'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-10'i><'col-sm-12 col-md-2'p>>",
                buttons: [{
                        extend: 'copy',
                        text: 'Copy',
                        className: 'custom-dt-button'
                    },
                    {
                        extend: 'csv',
                        text: 'CSV',
                        className: 'custom-dt-button'
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        className: 'custom-dt-button'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        className: 'custom-dt-button'
                    },
                    {
                        extend: 'colvis',
                        text: 'Columns',
                        className: 'custom-dt-button'
                    }
                ],
                order: [
                    [0, "desc"]
                ],
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5, 6],
                    visible: true
                }],
                lengthChange: true,
                language: {
                    paginate: {
                        previous: "Previous",
                        next: "Next",
                    }
                }
            });
        });
    </script>
@endsection
