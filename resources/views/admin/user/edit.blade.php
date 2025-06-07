@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Cập nhật thông tin tài khoản</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <form action="{{ route('admin.user.edit', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên đăng nhập</label>
                        <input class="form-control" name="username" type="text" value="{{ $user['username'] }}" readonly>
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu mới</label>
                        <input class="form-control" name="password" type="text" placeholder="Nhập mật khẩu mới">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tên người dùng</label>
                        <input class="form-control" name="name" type="text" value="{{ $user['name'] }}" disabled>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Vai trò </label>
                        <select class="form-control" name="role" aria-label="Default select example">
                            <option value="" disabled>Chọn Vai trò </option>
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Quản trị viên</option>
                            <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Khách Hàng</option>
                            <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Bị chặn</option>
                        </select>
                        @error('role')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số dư </label>
                        <input class="form-control" name="balance" type="number" value="{{ $user['balance'] }}" placeholder="Nhập số dư">
                        @error('balance')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <input class="form-control" name="email" type="email" value="{{ $user['email'] }}" disabled>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input class="form-control" name="phone" type="text" value="{{ $user['phone'] }}" disabled>
                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-primary mt-4" type="submit">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
@endsection
