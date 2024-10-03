@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa account</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.gameAccount.add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" >
                        <input type="hidden" name="creator_id" value="{{ Auth::check() ? Auth::user()->id : null }}">
                        <div class="form-group">
                            <label for="description">game_category_id</label>
                            <input type="text" class="form-control" id="description" aria-describedby=""
                                name="game_category_id" placeholder="ID danh mục game" >
                        </div>
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input required type="text" class="form-control" id="title" aria-describedby=""
                                name="title" placeholder="Nhập tiêu đề" >
                        </div>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input required type="text" class="form-control" id="username" aria-describedby=""
                                name="username" placeholder="Nhập tên đăng nhập" >
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu đăng nhập</label>
                            <input required type="text" class="form-control" id="password" aria-describedby=""
                                name="password" placeholder="Nhập mật khẩu đăng nhập" >
                        </div>
                        <div class="form-group">
                            <label for="AR">AR</label>
                            <input required type="number" class="form-control" id="AR" aria-describedby=""
                                name="AR" placeholder="Nhập AR" >
                        </div>
                        <div class="form-group">
                            <label for="server">Server</label>
                            <input required type="text" class="form-control" id="server" aria-describedby=""
                            name="server" placeholder="Nhập server" >
                        </div>
                        <div class="form-group">
                            <label for="price_in">Giá nhập khẩu</label>
                            <input required type="number" class="form-control" id="price_in" aria-describedby=""
                                name="price_in" placeholder="Nhập giá nhập khẩu" >
                        </div>
                        <div class="form-group">
                            <label for="price_out">Giá bán</label>
                            <input required type="number" class="form-control" id="price_out" aria-describedby=""
                                name="price_out" placeholder="Nhập giá bán" >
                        </div>
                        <div class="form-group">
                            <label for="note">Ghi chú</label>
                            <input required type="text" class="form-control" id="note" aria-describedby=""
                                name="note" placeholder="Nhập ghi chú" >
                        </div>
                        {{-- TODO: upload photo --}}
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" selected>Mở</option>
                                <option value="0" >Vô hiệu hoá</option>
                            </select>
                        </div>

                        <button class="btn btn-primary mt-4" type="button" onclick="window.history.back()">Quay Lại</button>
                        <button class="btn btn-success mt-4" type="submit">Lưu thay đổi</button>
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
