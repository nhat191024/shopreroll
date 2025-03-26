@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Danh sách Reroll Package</h1>
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.RerollPackage.showAdd') }}">Thêm Reroll Package</a>
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
                                <th class="col-2">Tên</th>
                                <th class="col-3">Giá</th>
                                <th class="col-4">Chức năng</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Mã</th>
                                <th class="col-2">Tên</th>
                                <th class="col-3">Giá</th>
                                <th class="col-4">Chức năng</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allRerollPackagies as $key => $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['price'] }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.RerollPackage.delete', $item->id) }}'; }">
                                            Xóa </a>
                                        <a class="btn btn-info" href="{{ route('admin.RerollPackage.showEdit', $item->id) }}">Sửa</a>
                                        <a class="btn btn-info" href="{{ route('admin.RerollPackage.detail', $item->id) }}">Chi tiết</a>
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
