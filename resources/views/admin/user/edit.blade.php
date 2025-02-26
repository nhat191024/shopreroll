@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    {{-- <form action="{{ route('admin.user.edit', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data"> --}}
                    <form action="{{ route('admin.user.edit', $user->id) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        <h1 class="h3 mb-2 text-gray-800">Cập nhật thông tin </h1>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="">ID tài khoản</label>
                                <input required type="text" class="form-control" name="id" value="{{ $user['id'] }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Cộng tiền (Nhập số âm để trừ tiền)</label>
                                <input type="number" class="form-control" name="addedBalance" placeholder="Nhập số tiền muốn thêm " value="0">
                            </div>
                            <div class="form-group col-6">
                                <label for="">Họ và tên</label>
                                <input required type="text" class="form-control" name="name" value="{{ $user['name'] }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Quyền hạn </label>
                                <select name="role" class="form-control" required>
                                    <option value="" {{ $user->role === null ? 'selected' : '' }}>Select Role</option>
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Quản trị viên</option>
                                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Cộng tác viên</option>
                                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Khách Hàng</option>
                                    <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Bị chặn</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Số dư hiện tại</label>
                                <input required type="text" class="form-control" name="" value="{{ number_format($user['balance'], 0, ',', '.') }} VND" readonly>
                                <input type="hidden" name="balance" value="{{ $user['balance'] }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="">tài khoản người dùng</label>
                                <input required type="text" class="form-control" name="username" value="{{ $user['username'] }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">E-mail tài khoản</label>
                                <input required type="email" class="form-control" name="email" value="{{ $user['email'] }}" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Số điện thoại tài khoản</label>
                                <input required type="number" class="form-control" name="phone" value="{{ $user['phone'] }}" readonly>
                            </div>
                            <div class="form-group col-12">
                                <h1 class="h3 mb-2 text-gray-800">Thay đổi mật khẩu </h1>
                                <label for="">Mật khẩu mới của tài khoản</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button class="btn btn-primary mt-4" type="submit" name="action" value="update">Cập nhật thông tin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
