@extends('admin.master01')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Thêm danh mục</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.reroll_category.add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="">Tên Reroll Category</label>
                        <input maxlength="255" required type="text" class="form-control" id="productName"
                            aria-describedby="" name="name" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="">Ghi chú</label>
                        <input type="text" class="form-control" id="productDescription" aria-describedby=""
                            name="note" placeholder="Nhập nội dung sản phẩm">
                    </div>
                    <label for="">Ảnh sản phẩm</label>
                    <div class="custom-file">
                        <input required type="file" accept="image/*" class="custom-file-input" id="customFile"
                            name="image">
                        <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                    </div>
                    <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                    <button id="saveAdd" class="btn btn-success mt-4" type="submit">Lưu</button>
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
