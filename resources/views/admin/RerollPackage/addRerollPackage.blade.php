@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Thêm gói reroll - {{ $subCategoryName }}</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.rerollPackage.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên gói reroll</label>
                            <input class="form-control" name="name" type="text" required maxlength="255" aria-describedby="" placeholder="Nhập tên gói reroll">
                        </div>
                        <div class="form-group">
                            <label for="">Giá gói reroll</label>
                            <input id="" class="form-control" name="price" type="number" required aria-describedby="" placeholder="Nhập giá gói reroll">
                        </div>
                        <input name="reroll_sub_category_id" type="hidden" value="{{ $subCategory }}">
                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <button id="saveAdd" class="btn btn-success mt-4" type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
