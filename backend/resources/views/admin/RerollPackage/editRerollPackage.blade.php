@extends('admin.master')
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
                    <form action="{{ route('admin.RerollPackage.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="">Tên Reroll Package</label>
                        <input maxlength="255" required type="text" class="form-control" id="productName"
                            aria-describedby="" name="name" value="{{ old('name', $rerollPackage->name ?? '') }}"
                            placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="">Giá</label>
                    <input required type="text" class="form-control" id="productDescription" aria-describedby=""
                        name="price" value="{{ old('price', $rerollPackage->price ?? '') }}"
                        placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="categorySelect">Chọn danh mục</label>
                    <select class="form-control" id="categorySelect" name="reroll_sub_category_id" required>
                        @foreach ($allRerollSubCategories as $id => $name)
                            @if ($id == $rerollPackage->reroll_sub_category_id)
                                <option value="{{ $id }}" selected>{{ $name }}</option>
                            @else
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="{{ $rerollPackage->id }}" name="id">
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
