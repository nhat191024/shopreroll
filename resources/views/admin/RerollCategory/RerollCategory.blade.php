@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Danh sách Reroll Category</h1>

        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.rerollCategory.create') }}">Thêm Reroll Category</a>
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
                                <th>Tên danh mục reroll</th>
                                <th>Ghi chú</th>
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rerollCategories as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td class="text-center"><img width="200px" src="{{ asset($item->image) }}" alt=""></td>
                                    <td class="text-center">
                                        @if ($item->status == 1)
                                            <span class="badge badge-success px-4 py-2">Hiện</span>
                                        @else
                                            <span class="badge badge-danger px-4 py-2">Ẩn</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status == 0)
                                            <a class="btn btn-success" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hiện item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.rerollCategory.ChangeStatus', $item->id) }}'; }">
                                                Hiện </a>
                                        @else
                                            <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.rerollCategory.ChangeStatus', $item->id) }}'; }">
                                                Ẩn </a>
                                        @endif
                                        <a class="btn btn-info" href="{{ route('admin.rerollCategory.edit', $item->id) }}">Sửa</a>
                                        <a class="btn btn-info" href="{{ route('admin.rerollSubCategory.index', $item->id) }}">
                                            Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên danh mục reroll</th>
                                <th>Ghi chú</th>
                                <th>Ảnh</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
