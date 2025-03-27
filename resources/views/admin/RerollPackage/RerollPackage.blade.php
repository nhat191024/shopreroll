@extends('admin.master')
@section('main')
    <div class="container-fluid">
        @if ($subCategory == 0)
            <h1 class="h3 mb-2 text-gray-800">Danh sách gói reroll</h1>
        @else
            <h1 class="h3 mb-2 text-gray-800">Danh sách gói reroll - {{ $subCategoryName }}</h1>
        @endif
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.rerollPackage.create') }}">Thêm gói reroll</a>
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
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->price) }} VNĐ</td>
                                    <td class="text-center">
                                        <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.rerollPackage.destroy', $item->id) }}'; }">Xóa</a>
                                        <a class="btn btn-info" href="{{ route('admin.rerollPackage.edit', $item->id) }}">Sửa</a>
                                        <a class="btn btn-info" href="{{ route('admin.rerollKey.index', $item->id) }}">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Chức năng</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
