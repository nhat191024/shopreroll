@extends('client.layouts.master')
@section('main')
<section class="content">

    <div class="container-fluid">
        <center>
            <img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" class="city__icon" />
        </center>
        <h1 class="guide__title">Acc đã mua</h1>
        <main>
            <div>
                <!-- Default box -->
                <div class="cardAcc card-solid offset-lg-1 col-lg-10">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="mt-3 table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">ID</th>
                                            <th style="width: 15%;">Tên đăng nhập</th>
                                            <th style="width: 15%;">Mật khẩu</th>
                                            <th style="width: 25%;">Thông tin</th>
                                            <th style="width: 10%;">Giá</th>
                                            <th style="width: 15%;">Tiêu đề giới thiệu</th>
                                            <th style="width: 10%;">Mua lúc</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allRechargeBill as $index => $data)
                                        <tr>
                                            <td>{{ $data->id }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->password }}</td>
                                            <td>UID: {{ $data->UID }}<br>Server: {{ $data->server }}<br>Character name: {{ $data->character_name }}<br>Note: {{ $data->note }}</td>
                                            <td>{{ number_format($data->RechargePackage->price) }} VND</td>
                                            <td>{{ $data->RechargePackage->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->locale('vi_VN')->isoFormat('d/m/Y H:m:s') }}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 5%;">ID</th>
                                            <th style="width: 15%;">Tên đăng nhập</th>
                                            <th style="width: 15%;">Mật khẩu</th>
                                            <th style="width: 25%;">Thông tin</th>
                                            <th style="width: 10%;">Giá</th>
                                            <th style="width: 15%;">Tiêu đề giới thiệu</th>
                                            <th style="width: 10%;">Mua lúc</th>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>
@endsection

