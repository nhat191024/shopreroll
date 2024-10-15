@extends('admin.master01')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa Banner</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.reroll_sub_category.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="">Tên Reroll Category</label>
                        <input maxlength="255" required type="text" class="form-control" id="productName"
                            aria-describedby="" name="name" value="{{ old('name', $rerollSubCategoryInfo->name ?? '') }}"
                            placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Hướng dẫn</label>
                    <input required type="text" class="form-control" id="productDescription" aria-describedby=""
                        name="tutorial" value="{{ old('tutorial', $rerollSubCategoryInfo->tutorial ?? '') }}"
                        placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Mã Youtube</label>
                    <input type="text" class="form-control" id="productDescription" aria-describedby="" name="id_youtube"
                        value="{{ old('id_youtube', $rerollSubCategoryInfo->id_youtube ?? '') }}"
                        placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">File download link</label>
                    <input type="text" class="form-control" id="productDescription" aria-describedby=""
                        name="file_download_link"
                        value="{{ old('file_download_link', $rerollSubCategoryInfo->file_download_link ?? '') }}"
                        placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="categorySelect">Chọn danh mục</label>
                    <select class="form-control" id="categorySelect" name="reroll_category_id" required>
                        @foreach ($rerollCategories as $id => $name)
                            @if ($id == $rerollSubCategoryInfo->reroll_category_id)
                                <option value="{{ $id }}" selected>{{ $name }}</option>
                            @else
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endif
                        @endforeach
                        {{-- <option value="">Chọn danh mục</option>
                        <option value="1" selected> oauidwyaiohlw</option> --}}
                    </select>
                </div>
                <label for="imageFrame">Ảnh sản phẩm</label>
                <div class="image-frame"
                    style="border: 2px dashed #ccc; padding: 10px; text-align: center; cursor: pointer;">
                    @if ($rerollSubCategoryInfo->image)
                        <img src="{{ asset('image/thumb/' . $rerollSubCategoryInfo['image']) }}" alt="Current Image"
                            id="currentImage" style="max-width: 150px; max-height: 150px;" />
                    @else
                        <span>Chưa có ảnh</span>
                    @endif
                    <input type="file" accept="image/*" id="imageInput" name="image" style="display: none;">
                </div>
                <input type="hidden" value="{{ $rerollSubCategoryInfo->id }}" name="id">
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
