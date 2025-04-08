@extends('admin.master')
@section('main')
    <div class="container-fluid">
        @if ($category == 0)
            <h1 class="h3 mb-2 text-gray-800">Danh sách danh mục reroll phụ</h1>
        @else
            <h1 class="h3 mb-2 text-gray-800">Danh sách danh mục reroll phụ - {{ $categoryName }}</h1>
        @endif
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.rerollCategory.index', $category) }}">Quay lại</a>
                <a class="btn btn-primary" href="{{ route('admin.rerollSubCategory.create') }}">Thêm danh mục reroll phụ</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <table id="dataTable" class="table-bordered table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mã</th>
                                <th>Tên Reroll Sub Category</th>
                                <th>Hướng dẫn</th>
                                <th>Ảnh</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rerollSubCategories as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['tutorial'] }}</td>
                                    <td class="text-center"><img width="200px" src="{{ asset($item->image) }}" alt=""></td>
                                    <td class="text-center">
                                        @if ($item->status == 0)
                                            <a class="btn btn-success" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hiện item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.rerollSubCategory.ChangeStatus', $item->id) }}'; }">Hiện </a>
                                        @else
                                            <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.rerollSubCategory.ChangeStatus', $item->id) }}'; }">Ẩn</a>
                                        @endif
                                        <a class="btn btn-info" href="{{ route('admin.rerollSubCategory.edit', $item->id) }}">Sửa</a>
                                        <a class="btn btn-info" href="{{ route('admin.rerollPackage.index', $item->id) }}">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên Reroll Sub Category</th>
                                <th>Hướng dẫn</th>
                                <th>Ảnh</th>
                                <th>Chức năng</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
