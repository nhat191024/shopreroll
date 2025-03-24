@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Danh mục game {{ $gameName }}</h1>
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.game.index') }}">Quay lại</a>
                <a class="btn btn-primary" href="{{ route('admin.GameCategory.showAdd') }}">Thêm danh mục mới</a>
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
                                <th>Tên danh mục (Tiếng Việt)</th>
                                <th>Ảnh danh mục</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên danh mục (Tiếng Việt)</th>
                                <th>Ảnh danh mục</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @php
                                $key = 0;
                            @endphp
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img width="200px" src="{{ url('image/thumb') . '/' . $item->image }}" alt=""></td>
                                    <td>{{ $item->status == 1 ? 'Hoạt động' : 'Đã ẩn' }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{ route('admin.GameCategory.showEdit', ['id' => $item->id]) }}">
                                            Sửa
                                        </a>
                                        @if ($item->status == 0)
                                            <a class="btn btn-success" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hiện item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.GameCategory.ChangeStatus', [$item->id, 1]) }}'; }">
                                                Hiện </a>
                                        @else
                                            <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.GameCategory.ChangeStatus', [$item->id, 0]) }}'; }">
                                                Ẩn </a>
                                        @endif
                                        <a class="btn btn-secondary" href="{{ route('admin.gameAccount.index', ['category_id' => $item->id, 'status' => 1]) }}">
                                            Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
