@extends('client.layouts.master')
@section('main')
    <center>
        <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" />
    </center>
    <h1 class="guide__title">{{ $title }}</h1>
    <div class="card card-solid offset-lg-1 offset-md-0 col-lg-10 col-md-12">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <h3 class="text-center">Thông tin ngân hàng, ví
                    </h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Thông tin
                                </th>
                                <th>Số tài khoản
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <b>Techcombank</b>
                                    <br>
                                    Lưu Thành Đạt
                                    <br>
                                    <small class="text-success">VN</small>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group row">
                                                <div class="input-group-prepend d-none d-sm-inline-block">
                                                    <span style="height: 100%" class="input-group-text"
                                                        data-toggle="tooltip" title=""
                                                        data-original-title="Nhấp vào số tài khoản để tự động copy"><i
                                                            class="fa fa-copy"></i></span>
                                                </div>
                                                <textarea readonly=""
                                                    onclick="if (!window.__cfRLUnblockHandlers) return false; copy_bank_accountNumber_MS00T01336694919545()"
                                                    id="bank_accountNumber_MS00T01336694919545" type="text" class="form-control">MS00T01336694919545</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <center>
                                                <img width="80%" class="img-thumbnail"
                                                    src="https://botsms.vn/qrbank.php?bankName=tcb&amp;accountNumber=MS00T01336694919545&amp;accountName=Lưu Thành Đạt&amp;money=0&amp;content=nap 311550">
                                            </center>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 col-lg-5">
                    <h3 class="text-center">Hướng dẫn
                    </h3>
                    <div class="card">
                        <div class="card-body">
                            <h5>Nội dung chuyển tiền
                            </h5>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="input-group row">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" data-toggle="tooltip" title=""
                                                data-original-title="Nhấp vào số tài khoản để tự động copy"><i
                                                    class="fa fa-copy"></i></span>
                                        </div>
                                        <input
                                            onclick="if (!window.__cfRLUnblockHandlers) return false; copy_autoBank_syntax_id()"
                                            id="autoBank_syntax_id" readonly="" type="text"
                                            class="form-control concave" value="nap {{ Auth::user()->id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-danger bg-dark p-2" style="border-radius: 0.25rem;">
                        <span style="font-weight: bolder;">Lưu ý!!!</span>&nbsp;
                        Hệ thống cộng tiền tự động trong 30s nên vui lòng chuyển đúng nội dung ở trên, cú pháp: <b>nap "ID USER"</b>
                    </p>
                    <p class="text-white bg-dark p-2" style="border-radius: 0.25rem;">
                        Nếu chuyển sai vui lòng liên hệ&nbsp;<span style="font-weight: bolder;">ADMIN&nbsp;</span>hoặc
                        số điện thoại<span style="font-weight: bolder;">&nbsp;0386496488</span>&nbsp;<span
                            style="font-weight: bolder;">(12h-24h)</span>&nbsp;để
                        được hỗ trợ.
                    </p>
                    <p class="text-white bg-dark p-2" style="border-radius: 0.25rem;">
                        <span style="font-weight: bolder; word-spacing: 1px;">
                            <font color="#ff0000" style="background-color: rgba(0, 0, 0, 0.73);">
                                <u style="background-color: rgb(255, 255, 0);">Techcombank</u>
                            </font>
                            <font style="">
                                <font color="#ff0000" style=""><span style="word-spacing: 1px;"><b
                                            style=""><span
                                                style="background-color: rgba(0, 0, 0, 0.73);">&nbsp;</span><u
                                                style="background-color: rgb(255, 255, 0);">Techcombank</u></b></span>
                                </font><span style="word-spacing: 1px;">
                                    <font color="#ffffff" style="background-color: rgba(0, 0, 0, 0.73);">&nbsp;thì trong
                                        vòng 1 ngày mà khách chuyển thêm trùng số tiền thì sẽ bị delay đến hôm sau. Mẹo khắc
                                        phục là </font><u style="">
                                        <font color="#ff0000" style="background-color: rgb(255, 255, 0);">chuyển lệch 1đ
                                        </font>
                                    </u>
                                    <font color="#ffffff" style="background-color: rgba(0, 0, 0, 0.73);"> nếu nạp thêm.
                                    </font>
                                </span>
                            </font>
                        </span><br>
                    </p>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
