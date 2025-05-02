@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Thêm mới tài khoản</h1>
        <!-- DataTales Example -->
        <div class="card mb-4 shadow">
            <div class="card-body">
                <form action="" method="post" {{ route('admin.user.add') }} enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên đăng nhập</label>
                        <input class="form-control" name="username" type="text" required placeholder="Nhập tài khoản ">
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu</label>
                        <input class="form-control" name="password" type="text" required placeholder="Nhập mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="">Tên người dùng</label>
                        <input class="form-control" name="name" type="text" required placeholder="Nhập họ và tên">
                    </div>
                    <div class="form-group">
                        <label for="">Vai trò </label>
                        <select class="form-control" name="role" required aria-label="Default select example">
                            <option value="" disabled>Chọn Vai trò </option>
                            <option value="1">Quản trị viên</option>
                            <option value="2">Cộng tác viên</option>
                            <option value="0">Khách Hàng</option>
                            <option value="3">Bị chặn</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Số dư </label>
                        <input class="form-control" name="balance" type="number" value="0" placeholder="Nhập số dư (Không bắt buộc)">
                    </div>
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <input class="form-control" name="email" type="email" required placeholder="Nhập E-mail">
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input class="form-control" name="phone" type="text" required placeholder="Nhập số điện thoại">
                    </div>
                    <button class="btn btn-success mt-4" type="submit">Thêm</button>
                </form>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
