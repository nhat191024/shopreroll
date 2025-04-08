@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Thêm danh mục phụ</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.rerollSubCategory.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên danh mục phụ</label>
                            <input id="" class="form-control" name="name" type="text" required maxlength="255" aria-describedby="" placeholder="Nhập tên danh mục phụ">
                        </div>
                        <div class="form-group">
                            <label for="">Hướng dẫn</label>
                            <input id="" class="form-control" name="tutorial" type="text" required aria-describedby="" placeholder="Nhập hướng dẫn">
                        </div>
                        <div class="form-group">
                            <label for="">Mã Youtube</label>
                            <input id="" class="form-control" name="id_youtube" type="text" aria-describedby="" placeholder="Nhập mã youtube (có thể trống)">
                        </div>
                        <div class="form-group">
                            <label for="">File download link</label>
                            <input id="" class="form-control" name="file_download_link" type="text" aria-describedby="" placeholder="Nhập link download file (có thể trống)">
                        </div>
                        <div class="form-group">
                            <label for="categorySelect">Chọn danh mục</label>
                            <select id="status" class="form-control" name="reroll_category_id" required>
                                <option value="" disabled>Chọn danh mục</option>
                                @foreach ($rerollCategories as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh sản phẩm</label>
                            <div class="custom-file">
                                <input id="customFile" class="custom-file-input" name="image" type="file" required accept="image/*">
                                <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                            </div>
                        </div>
                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <button id="saveAdd" class="btn btn-success mt-4" type="submit">Lưu</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
