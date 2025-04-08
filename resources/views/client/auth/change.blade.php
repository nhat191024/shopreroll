@extends('client.layouts.auth')
@section('form-content')
    <div class="col-lg-12 card">
        <div class="mt-3">
            <form action="{{ \Route::currentRouteName() !== 'client.user.reset' ? route('client.user.change.confirm') : route('client.user.reset.confirm') }}" method="POST">
                @csrf
                @if (\Route::currentRouteName() !== 'client.user.reset')
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="">Mật khẩu hiện tại</label>
                        <div class="col-md-6">
                            <input class="concave form-control" name="current_password" type="password"
                                placeholder="Nhập mật khẩu hiện tại">
                            @if ($errors->has('current_password'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                @else
                    <input class="hidden" name="reset_token" type="hidden" value="{{ isset($reset_token) ? $reset_token : '' }}">
                    <input class="hidden" name="reset_email" type="hidden" value="{{ isset($reset_email) ? $reset_email : '' }}">
                @endif
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="">Mật khẩu mới</label>
                    <div class="col-md-6">
                        <input class="concave form-control" name="new_password" type="password"
                            placeholder="Nhập mật khẩu mới">
                        @if ($errors->has('new_password'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('new_password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right" for="">Xác nhận mật khẩu</label>
                    <div class="col-md-6">
                        <input class="concave form-control" name="new_password_confirmation" type="password"
                            placeholder="Xác nhận mật khẩu mới">
                        @if ($errors->has('new_password_confirmation'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Đổi mật khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
