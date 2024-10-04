@extends('admin.master01')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Thêm mới tài khoản</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <form action="" method="post" {{ route('admin.user.add') }} enctype="multipart/form-data">
                        @csrf
                        <div class="row ">
                            <div class="form-group col-6 ">
                                <label for="">Tên đăng nhập</label>
                                <input required type="text" class="form-control" id="" aria-describedby=""
                                    name="username" placeholder="Nhập tài khoản đăng nhập ">
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Mật khẩu</label>
                                <input required type="text" class="form-control" id="" aria-describedby=""
                                    name="password" placeholder="Nhập mật khẩu đăng nhập">
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Tên người dùng</label>
                                <input required type="text" class="form-control" id="" aria-describedby=""
                                    name="name" placeholder="Nhập họ và tên">
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Vai trò  </label>
                                <select name="role" class="form-control" aria-label="Default select example" required>
                                    <option value="">Chọn Vai trò </option>
                                    <option value="1">Quản trị viên</option>
                                    <option value="2">Cộng tác viên</option>
                                    <option value="0">Khách Hàng</option>
                                    <option value="3">Bị chặn</option>
                                </select>
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Số dư </label>
                                <input type="number" class="form-control" id="" aria-describedby="" name="balance"
                                    placeholder="Nhập số dư (Không bắt buộc)" value="0">
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">E-mail</label>
                                <input required type="email" class="form-control" id="" aria-describedby=""
                                    name="email" placeholder="Nhập E-mail">
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Số điện thoại</label>
                                <input required type="text" class="form-control" id="" aria-describedby=""
                                    name="phone" placeholder="Nhập số điện thoại">
                            </div>
                        </div>
                        <button class="btn btn-success mt-4" type="submit">Thêm</button>


                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- End of Content Wrapper -->
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
