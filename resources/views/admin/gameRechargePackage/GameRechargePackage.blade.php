@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Gói nạp - {{ $rechargeName }}</h1>
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.gameRechargePackage.create', $id) }}">Thêm gói nạp cho {{ $rechargeName }}</a>
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
                                <th>Tên gói nạp</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $key = 0;
                            @endphp
                            @foreach ($rechargePackages as $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->price) }} VNĐ</td>
                                    <td>{{ $item->status == 1 ? 'Hiện' : 'Ẩn' }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{ route('admin.gameRechargePackage.edit', $item->id) }}">Sửa</a>
                                        @if ($item->status == 0)
                                            <a class="btn btn-success" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hiện item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.gameRechargePackage.destroy', [$item->id, 1]) }}'; }">Hiện</a>
                                        @else
                                            <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.gameRechargePackage.destroy', [$item->id, 0]) }}'; }">Ẩn</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên gói nạp</th>
                                <th>Giá</th>
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
