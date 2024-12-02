@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa danh mục</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.GameCategory.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên danh mục</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="category_name" placeholder="Nhập tên danh mục bằng Tiếng Việt" value="{{ $gameCategoryInfo['name'] }}">
                        </div>
                        <div class="form-group">
                            <label for="category_image">Hình ảnh danh mục (Bỏ trống nếu không muốn cập nhật ảnh)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="category_image" name="category_image">
                                <label class="custom-file-label" for="category_image">Chọn ảnh</label>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="game_id">Chọn game</label>
                            <select required class="form-control" id="game_id" name="game_id">
                                @foreach ($game as $item)
                                    <option value="{{ $item->id }}" {{ $item['id'] == $gameCategoryInfo['game_id'] ? "selected" : ""  }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="category_id" value="{{ $id }}">
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
