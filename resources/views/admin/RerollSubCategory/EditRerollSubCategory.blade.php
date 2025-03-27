@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Sửa danh mục reroll phụ - {{ $rerollSubCategory->name }}</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.rerollSubCategory.update', $rerollSubCategory->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên danh mục reroll phụ</label>
                            <input id="" class="form-control" name="name" type="text" required value="{{ old('name', $rerollSubCategory->name ?? '') }}" maxlength="255" aria-describedby="" placeholder="Nhập tên danh mục phụ">
                        </div>
                        <div class="form-group">
                            <label for="">Hướng dẫn</label>
                            <input id="" class="form-control" name="tutorial" type="text" required value="{{ old('tutorial', $rerollSubCategory->tutorial ?? '') }}" aria-describedby="" placeholder="Nhập hướng dẫn">
                        </div>
                        <div class="form-group">
                            <label for="">Mã Youtube</label>
                            <input id="" class="form-control" name="id_youtube" type="text" value="{{ old('id_youtube', $rerollSubCategory->id_youtube ?? '') }}" aria-describedby="" placeholder="Nhập mã youtube (có thể trống)">
                        </div>
                        <div class="form-group">
                            <label for="">File download link</label>
                            <input id="" class="form-control" name="file_download_link" type="text" value="{{ old('file_download_link', $rerollSubCategory->file_download_link ?? '') }}" aria-describedby="" placeholder="Nhập link download file (có thể trống)">
                        </div>
                        <div class="form-group">
                            <label for="categorySelect">Chọn danh mục</label>
                            <select id="categorySelect" class="form-control" name="reroll_category_id" required>
                                @foreach ($rerollCategories as $id => $name)
                                    <option value="{{ $id }}" {{ $id == $rerollSubCategory->reroll_category_id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh</label>
                            <div class="custom-file">
                                <input id="customFile" class="custom-file-input" name="image" type="file" accept="image/*">
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
