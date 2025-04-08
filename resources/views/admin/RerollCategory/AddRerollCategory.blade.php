@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Thêm danh mục</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.rerollCategory.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên Reroll Category</label>
                            <input id="productName" class="form-control" name="name" type="text" required maxlength="255" aria-describedby="" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Ghi chú</label>
                            <input id="productDescription" class="form-control" name="note" type="text" aria-describedby="" placeholder="Nhập nội dung sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Ảnh sản phẩm</label>
                            <div class="custom-file">
                                <input id="customFile" class="custom-file-input" name="image" type="file" required accept="image/*">
                                <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                            </div>
                        </div>
                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <button class="btn btn-success mt-4" type="submit">Lưu</button>
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
