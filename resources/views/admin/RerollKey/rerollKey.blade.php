@extends('admin.master')
@section('main')
    <div class="container-fluid">
        @if (isset($packageName))
            <h1 class="h3 mb-2 text-gray-800">Danh sách Reroll Key</h1>
        @else
            <h1 class="h3 mb-2 text-gray-800">Danh sách Reroll Key - {{ $packageName }}</h1>
        @endif
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.rerollSubCategory.index', $idPackage) }}">Quay lại</a>
                <a class="btn btn-primary" href="{{ route('admin.rerollKey.create', $idPackage) }}">Thêm Reroll Key - {{ $packageName }}</a>
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
                                <th>ID</th>
                                <th>Key</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rerollKeys as $key => $item)
                                <tr>
                                    <td style="width: 5%">{{ ++$key }}</td>
                                    <td>{{ $item->key }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn xóa key {{ $item->id }} chứ?')) { window.location.href = '{{ route('admin.rerollKey.destroy', $item->id) }}'; }">Xóa</a>
                                        <a class="btn btn-info" href="{{ route('admin.rerollKey.edit', $item->id) }}">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Key</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
