@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="row">
                    {{-- <form action="{{ route('admin.user.edit', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data"> --}}
                    <form action="{{ route('admin.user.edit', $user->id) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        <h1 class="h3 mb-2 text-gray-800">Cập nhật thông tin </h1>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">ID tài khoản</label>
                                <input class="form-control" name="id" type="text" required value="{{ $user['id'] }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Cộng tiền (Nhập số âm để trừ tiền)</label>
                                <input class="form-control" name="addedBalance" type="number" value="0" placeholder="Nhập số tiền muốn thêm ">
                            </div>
                            <div class="form-group col-6">
                                <label for="">Họ và tên</label>
                                <input class="form-control" name="name" type="text" required value="{{ $user['name'] }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Quyền hạn </label>
                                <select class="form-control" name="role" required>
                                    <option value="" disabled {{ $user->role === null ? 'selected' : '' }}>Select Role</option>
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Quản trị viên</option>
                                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Khách Hàng</option>
                                    <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Bị chặn</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Số dư hiện tại</label>
                                <input class="form-control" name="" type="text" required value="{{ number_format($user['balance'], 0, ',', '.') }} VND" readonly>
                                <input name="balance" type="hidden" value="{{ $user['balance'] }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="">tài khoản người dùng</label>
                                <input class="form-control" name="username" type="text" required value="{{ $user['username'] }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">E-mail tài khoản</label>
                                <input class="form-control" name="email" type="email" required value="{{ $user['email'] }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Số điện thoại tài khoản</label>
                                <input class="form-control" name="phone" type="number" required value="{{ $user['phone'] }}" readonly>
                            </div>
                            <div class="form-group col-12">
                                <h1 class="h3 mb-2 text-gray-800">Thay đổi mật khẩu </h1>
                                <label for="">Mật khẩu mới của tài khoản</label>
                                <input class="form-control" name="password" type="password" placeholder="Nhập mật khẩu mới">
                            </div>
                        </div>
                        <input name="id" type="hidden" value="{{ $user->id }}">
                        <button class="btn btn-primary mt-4" name="action" type="submit" value="update">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
