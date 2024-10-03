@extends('admin.master01')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('admin.user.edit', ['id' => $user->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <h1 class="h3 mb-2 text-gray-800">Cập nhật thông tin </h1>
                        <div class="row ">
                            <div class="form-group col-6 ">
                                <label for="">ID tài khoản</label>
                                <input required type="text" class="form-control" id="" aria-describedby=""
                                    name="id" value="{{ $user['id'] }}" readonly>
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Cộng tiền (Nhập số âm để trừ tiền)</label>
                                <input type="number" class="form-control" id="" aria-describedby=""
                                    name="plusbalance" placeholder="Nhập số tiền muốn thêm ">

                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Tên người dùng</label>
                                <input required type="text" class="form-control" id="" aria-describedby=""
                                    name="name" value="{{ $user['name'] }}" readonly>
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Quyền hạn </label>
                                <select name="role" class="form-control" aria-label="Default select example" required>
                                    <option value="" readonly {{ $user->role === null ? 'selected' : '' }}>Select Role
                                    </option>
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Quản trị viên</option>
                                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Cộng tác viên</option>
                                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Khách Hàng</option>
                                    <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Bị chặn</option>
                                </select>
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Số dư </label>
                                <input required type="number" class="form-control" id="" aria-describedby=""
                                    name="" value="{{ $user['balance'] }}" readonly>
                                <input type="hidden" name="balance" value="{{ $user['balance'] }}">
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">tài khoản người dùng</label>
                                <input required type="text" class="form-control" id="" aria-describedby=""
                                    name="username" value="{{ $user['username'] }}" readonly>
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">E-mail tài khoản</label>
                                <input required type="email" class="form-control" id="" aria-describedby=""
                                    name="email" value="{{ $user['email'] }}" readonly>
                            </div>
                            <div class="form-group col-6 ">
                                <label for="">Số điện thoại tài khoản</label>
                                <input required type="number" class="form-control" id="" aria-describedby=""
                                    name="phone" value="{{ $user['phone'] }}" readonly>
                            </div>
                            <div class="form-group col-12 ">
                                <h1 class="h3 mb-2 text-gray-800">Thay đổi mật khẩu </h1>
                                <label for="">Mật khẩu mới của tài khoản</label>
                                <input required type="password" class="form-control" id="" aria-describedby=""
                                    name="password" placeholder="Nhập mật khẩu mới">
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button class="btn btn-success mt-4" type="submit" name="action" value="editBalance">Cộng/Trừ
                            tiền</button>
                        <button class="btn btn-warning mt-4" type="submit" name="action" value="editRole">Sửa quyền
                            hạn</button>
                        <button class="btn btn-primary mt-4" type="submit" name="action" value="changePass">Đổi mật
                            khẩu</button>

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
