@extends('admin.master')
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
                    <form action="{{ route('admin.rerollSubCategory.add') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            <label for="">Tên Reroll Category</label>
                            <input maxlength="255" required type="text" class="form-control" id="productName"
                                aria-describedby="" name="name" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Hướng dẫn</label>
                            <input required type="text" class="form-control" id="productDescription" aria-describedby=""
                                name="tutorial" placeholder="Nhập nội dung sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Mã Youtube</label>
                            <input type="text" class="form-control" id="productDescription" aria-describedby=""
                                name="id_youtube" placeholder="Nhập nội dung sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">File download link</label>
                            <input type="text" class="form-control" id="productDescription" aria-describedby=""
                                name="file_download_link" placeholder="Nhập nội dung sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="categorySelect">Chọn danh mục</label>
                            <select class="form-control" id="status" name="reroll_category_id" required>
                                @foreach ($allRerollCategories as $id => $name)
                                    <option value="{{ $id }}" {{ $loop->first ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" id="status" name="reroll_category_id" required>
                                <option value="0" {{ (old('status', $rerollCategoryInfo->status ?? '') == 0) ? 'selected' : '' }}>Không hoạt động</option>
                                <option value="1" {{ (old('status', $rerollCategoryInfo->status ?? '') == 1) ? 'selected' : '' }}>Hoạt động</option>
                            </select>
                        </div> --}}
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
