@extends('client.layouts.auth')
@section('form-content')
    <div class="col-lg-12 card ">
        <div class="mt-3">
            <form action="{{ route('login.auth') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="">Tài khoản</label>
                    <div class="col-md-6">
                        <input class="concave form-control " name="username" type="text" placeholder="Nhập tài khoản"
                            value="{{ old('username') }}">
                        @if ($errors->has('username'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="">Mật khẩu</label>
                    <div class="col-md-6">
                        <input class="concave form-control " name="password" type="password" placeholder="Nhập mật khẩu"
                            value="{{ old('password') }}">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Đăng nhập
                    </button>
                    <a href="{{ route('register') }}">
                        <button type="button" class="btn btn-light">
                            Đăng ký
                        </button>
                    </a>
                    <a class="btn btn-link" href="{{ route('client.user.forgot') }}">
                        Quên mật khẩu? Lấy lại

                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
