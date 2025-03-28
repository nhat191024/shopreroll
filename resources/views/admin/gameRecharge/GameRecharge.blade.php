@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Nạp game</h1>
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.gameRecharge.create') }}">Thêm</a>
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
                                <th style="width: 2%;">STT</th>
                                <th style="width: 10%;">Trò chơi</th>
                                <th style="width: 25%;">Hướng dẫn</th>
                                <th>ID Youtube</th>
                                <th style="width: 20%;">Ảnh</th>
                                <th style="width: 7%;">Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gameRecharges as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->tutorial }}</td>
                                    <td>{{ $item->id_youtube ?? "không có" }}</td>
                                    <td>
                                        <img style="width: 240px; height: 240px; object-fit: contain;" src="{{ asset($item->image) }}" alt="">
                                    </td>
                                    <td>{{ $item->status == 1 ? 'Hoạt động' : 'Đã ẩn' }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{ route('admin.gameRecharge.edit', $item->id) }}">
                                            Sửa
                                        </a>
                                        @if ($item->status == 0)
                                            <a class="btn btn-success"
                                                onclick="event.preventDefault();
                                                        if (confirm('Bạn chắc chắn muốn hiện item {{ $item->name }} chứ?')) {
                                                            window.location.href = '{{ route('admin.gameRecharge.changeStatus', [$item->id, 1]) }}';
                                                        }">
                                                Hiện
                                            </a>
                                        @else
                                            <a class="btn btn-danger"
                                                onclick="event.preventDefault();
                                                        if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) {
                                                            window.location.href = '{{ route('admin.gameRecharge.changeStatus', [$item->id, 0]) }}';
                                                        }">
                                                Ẩn
                                            </a>
                                        @endif
                                        <a class="btn btn-primary" href="{{ route('admin.gameRechargePackage.index', $item->id) }}">Packages</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Trò chơi</th>
                                <th>Hướng dẫn</th>
                                <th>ID Youtube</th>
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
