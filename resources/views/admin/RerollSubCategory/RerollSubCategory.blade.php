@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Danh sách Reroll Sub Category</h1>
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.rerollSubCategory.showAdd') }}">Thêm Reroll Sub Category</a>
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
                                <th class="col-2">Tên Reroll Sub Category</th>
                                <th class="col-3">Hướng dẫn</th>
                                <th>Ảnh</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Mã</th>
                                <th class="col-2">Tên Reroll Sub Category</th>
                                <th class="col-3">Hướng dẫn</th>
                                <th>Ảnh</th>
                                <th>Chức năng</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($allRerollSubCategory as $key => $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['tutorial'] }}</td>
                                    <td class="text-center"><img width="200px" src="{{ asset('image/thumb/' . $item['image']) }}" alt=""></td>
                                    <td class="text-center">
                                        @if ($item->status == 0)
                                            <a class="btn btn-success" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hiện item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.RerollSubCategory.ChangeStatus', $item->id) }}'; }">
                                                Hiện </a>
                                        @else
                                            <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.RerollSubCategory.ChangeStatus', $item->id) }}'; }">
                                                Ẩn </a>
                                        @endif
                                        <a class="btn btn-info" href="{{ route('admin.RerollSubCategory.ShowEdit', $item->id) }}">Sửa</a>
                                        <a class="btn btn-info" href="{{ route('admin.RerollSubCategory.Detail', $item->id) }}">Chi tiết</a>
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
