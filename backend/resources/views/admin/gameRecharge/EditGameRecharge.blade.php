@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Thêm Game Recharge</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.GameRecharge.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên trò chơi</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="name" placeholder="Nhập tên trò chơi" value="{{ $gameRechargeInfo['name'] }}">
                        </div>
                        <div class="form-group">
                            <label for="">Hướng dẫn</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="tutorial" placeholder="Nhập hướng dẫn" value="{{ $gameRechargeInfo['tutorial'] }}">
                        </div>
                        <div class="form-group">
                            <label for="">ID Youtube</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="id_youtube" placeholder="Nhập hướng dẫn" value="{{ $gameRechargeInfo['id_youtube'] }}">
                        </div>
                        <div class="form-group">
                            <label for="recharge_image">Hình ảnh nạp tiền trò chơi (Bỏ trống nếu không muốn cập nhật ảnh)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="recharge_image" name="recharge_image">
                                <label class="custom-file-label" for="recharge_image">Chọn ảnh</label>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button class="btn btn-success mt-4" type="submit">SỬA</button>
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
