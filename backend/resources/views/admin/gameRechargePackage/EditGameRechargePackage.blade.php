@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa gói nạp trò chơi</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.GameRechargePackage.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên gói nạp</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="name" value="{{ $package['name'] }}" placeholder="Nhập tên gói nạp">
                        </div>
                        <div class="form-group">
                            <label for="">Giá trị gói nạp</label>
                            <input required type="number" class="form-control" id="" aria-describedby=""
                                name="price" value="{{ $package['price'] }}" placeholder="Nhập giá trị gói nạp" min="1" max="9999999">
                        </div>

                        <div class="form-group">
                            <label for="game_recharge_id">Chọn trò chơi</label>
                            <select class="form-control" id="game_recharge_id" name="game_recharge_id">
                                @foreach ($game as $item)
                                <option value="{{ $item->id }}" {{ $item['id'] == $package['game_recharge_id'] ? "selected" : ""  }}>
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="id" value="{{ $id }}">
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
