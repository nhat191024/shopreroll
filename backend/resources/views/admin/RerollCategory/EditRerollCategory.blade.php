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
                    <form action="{{ route('admin.RerollCategory.ShowEdit', $rerollCategoryInfo->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="productName">Tên Reroll Category</label>
                            <input maxlength="255" required type="text" class="form-control" id="productName"
                                name="name" value="{{ old('name', $rerollCategoryInfo->name ?? '') }}"
                                placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="productName">Ghi chú</label>
                            <input maxlength="255" required type="text" class="form-control" id="productNote"
                                name="note" value="{{ old('note', $rerollCategoryInfo->note ?? '') }}"
                                placeholder="Nhập tên sản phẩm">
                        </div>
                        {{-- <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="0" {{ (old('status', $rerollCategoryInfo->status ?? '') == 0) ? 'selected' : '' }}>Không hoạt động</option>
                                <option value="1" {{ (old('status', $rerollCategoryInfo->status ?? '') == 1) ? 'selected' : '' }}>Hoạt động</option>
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="imageFrame">Ảnh sản phẩm</label>
                            <div class="image-frame" style="border: 2px dashed #ccc; padding: 10px; text-align: center; cursor: pointer;">
                                @if($rerollCategoryInfo->image)
                                    <img src="{{ asset('image/thumb/' . $rerollCategoryInfo['image']) }}" alt="Current Image" id="currentImage" style="max-width: 150px; max-height: 150px;"/>
                                @else
                                    <span>Chưa có ảnh</span>
                                @endif
                                <input type="file" accept="image/*" id="imageInput" name="image" style="display: none;">
                            </div>
                        </div>
                            <input type="hidden" value="{{ $rerollCategoryInfo->id }}" name="id">
                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <button class="btn btn-success mt-4" type="submit">Lưu chỉnh sửa</button>
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
