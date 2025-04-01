@extends('client.layouts.auth')
@section('form-content')
<div class="col-lg-12 card">
    <div class="mt-3">
        <form action="{{ route('register.auth') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="">Họ và tên</label>
                <div class="col-md-6">
                    <input class="concave form-control" name="name" type="text" placeholder="Tên sẽ hiển thị công khai" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="">Tên đăng nhập</label>
                <div class="col-md-6">
                    <input class="concave form-control" name="username" type="text" placeholder="Giữ bí mật, ghi khác họ & tên" value="{{ old('username') }}">
                    @if ($errors->has('username'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="">Số điện thoại</label>
                <div class="col-md-6">
                    <input class="concave form-control" name="phone" type="text" placeholder="SĐT cá nhân của bạn" value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="">Địa chỉ email</label>
                <div class="col-md-6">
                    <input class="concave form-control" name="email" type="text" placeholder="Email cá nhân của bạn" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="">Mật khẩu</label>
                <div class="col-md-6">
                    <input class="concave form-control" name="password" type="password" placeholder="Điền tối thiểu 6 ký tự">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right" for="">Xác nhận mật khẩu</label>
                <div class="col-md-6">
                    <input class="concave form-control" name="password_confirmation" type="password" placeholder="Nhập lại giống bên trên">
                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Đăng ký
                </button>
                <a href="{{ route('login') }}">
                    <button type="button" class="btn btn-light" type="button">
                        Đăng nhập
                    </button>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
