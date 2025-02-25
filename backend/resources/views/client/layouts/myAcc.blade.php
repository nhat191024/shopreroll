@extends('client.layouts.master')
@section('main')
<section class="content">

    <div class="container-fluid">
        <center>
            <img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" class="city__icon" />
        </center>
        <h1 class="guide__title">Acc Genshin đã mua</h1>
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
                                        @foreach ($accountBills as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{ $data->GameAccount ? $data->GameAccount->username : 'N/A' }}</td>
                                            <td>{{ $data->GameAccount ? $data->GameAccount->password : 'N/A' }}</td>
                                            <td>Server: {{ $data->GameAccount ? $data->GameAccount->server : 'N/A' }}<br>
                                                AR {{ $data->GameAccount ? $data->GameAccount->AR : 'N/A' }}<br>
                                                Note: {{ $data->GameAccount ? $data->GameAccount->note : 'N/A' }}</td>
                                            <td>{{ $data->price }}</td>
                                            <td>{{ $data->GameAccount ? $data->GameAccount->title : 'N/A' }}</td>
                                            <td>{{ $data->created_at }}</td>
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

