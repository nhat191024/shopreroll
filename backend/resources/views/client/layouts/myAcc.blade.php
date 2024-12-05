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
                                            <th style="width: 2%;">STT</th>
                                            <th style="width: 30%;">Tài khoản</th>
                                            <th style="width: 50%;">Mật khẩu</th>
                                            <th style="width: 20%;">Thông tin</th>
        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allRechargeBill as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>account1</td>
                                            <td>123456789</td>
                                            <td>
                                                <a href="#" class="btn btn-primary">Xem thông tin</a>
                                            </td>
                                        </tr>
                                        @endforeach
               
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 2%;">STT</th>
                                            <th style="width: 30%;">Tài khoản</th>
                                            <th style="width: 50%;">Mật khẩu</th>
                                            <th style="width: 20%;">Thông tin</th>
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

