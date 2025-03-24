@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Thêm danh mục</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.GameCategory.add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên danh mục</label>
                            <input id="" class="form-control" name="category_name" type="text" required aria-describedby="" placeholder="Nhập tên danh mục bằng Tiếng Việt">
                        </div>
                        <div class="form-group">
                            <label for="category_image">Hình ảnh danh mục</label>
                            <div class="custom-file">
                                <input id="category_image" class="custom-file-input" name="category_image" type="file">
                                <label class="custom-file-label" for="category_image">Chọn ảnh</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_id">Chọn game</label>
                            <select id="product_id" class="form-control" name="game_id">
                                @foreach ($game as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success mt-4" type="submit">Thêm danh mục</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
