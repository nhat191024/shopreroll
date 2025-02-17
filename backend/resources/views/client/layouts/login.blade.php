@extends('client.layouts.master')
@section('main')
    <div class="vh-100">
        <div class="cardAcc card-solid offset-lg-3 col-md-6">
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="mt-3">
                        <form action="{{ route('login.auth') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="">Tài khoản</label>
                                <div class="col-md-6">
                                    <input class="concave form-control " name="username" type="text"
                                        placeholder="Nhập tài khoản">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="">Mật khẩu</label>
                                <div class="col-md-6">
                                    <input class="concave form-control " name="password" type="text"
                                        placeholder="Nhập mật khẩu">
                                </div>
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary">
                                    Đăng nhập
                                </button>
                                <a href="">
                                    <button class="btn btn-light">
                                        Đăng ký
                                    </button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
