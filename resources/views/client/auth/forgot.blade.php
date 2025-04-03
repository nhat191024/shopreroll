@extends('client.layouts.auth')
@section('form-content')
<div class="col-lg-12 card">
    <div class="mt-3">
        <form action="{{ route('client.user.forgot.confirm') }}" method="POST">
            @csrf
            <div class="form-group row">
            <label class="col-md-4 col-form-label text-md-right" for="email">Email</label>
            <div class="col-md-6">
                <input class="concave form-control" name="email" type="email" placeholder="Nhập email"
                value="{{ old('email') }}">
                @if ($errors->has('email'))
                <span class="invalid-feedback d-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            </div>
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Gửi link đặt lại mật khẩu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
