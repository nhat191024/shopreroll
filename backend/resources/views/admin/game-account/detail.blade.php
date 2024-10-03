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
                    <form>
                        <div class="form-group">
                            <label for="game_category_id">Game Category ID</label>
                            <input type="text" class="form-control" id="game_category_id" value="{{ $gameAccount->GameCategory->id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" value="{{ $gameAccount->title }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" value="{{ $gameAccount->username }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu đăng nhập</label>
                            <input type="text" class="form-control" id="password" value="{{ $gameAccount->password }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="AR">AR</label>
                            <input type="number" class="form-control" id="AR" value="{{ $gameAccount->AR }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="server">Server</label>
                            <input type="text" class="form-control" id="server" value="{{ $gameAccount->server }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="price_in">Giá nhập khẩu</label>
                            <input type="number" class="form-control" id="price_in" value="{{ $gameAccount->price_in }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="price_out">Giá bán</label>
                            <input type="number" class="form-control" id="price_out" value="{{ $gameAccount->price_out }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="note">Ghi chú</label>
                            <input type="text" class="form-control" id="note" value="{{ $gameAccount->note }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <input type="text" class="form-control" id="status" value="{{ $gameAccount->status == 1 ? 'Mở' : 'Vô hiệu hoá' }}" readonly>
                        </div>

                        <button class="btn btn-primary mt-4" type="button" onclick="window.history.back()">Quay Lại</button>
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
