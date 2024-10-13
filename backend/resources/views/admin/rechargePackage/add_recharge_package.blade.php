@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Thêm gói nạp trò chơi</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.package.add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên gói nạp</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="name" placeholder="Nhập tên gói nạp">
                        </div>
                        <div class="form-group">
                            <label for="">Giá trị gói nạp</label>
                            <input required type="number" class="form-control" id="" aria-describedby=""
                                name="price" placeholder="Nhập giá trị gói nạp">
                        </div>
                        
                        <div class="form-group">
                            <label for="product_id">Chọn trò chơi</label>
                            <select class="form-control" id="product_id" name="game_recharge_id">
                                @foreach ($gameRecharge as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success mt-4" type="submit">Thêm gói nạp</button>
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
