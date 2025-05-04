@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.user.show') }}">Thêm tài khoản</a>
            </div>
            <div class="card-body">
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
                <div class="table-responsive">
                    <table id="dataTable" class="table-bordered table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Họ và tên</th>
                                <th>Số dư hiện tại</th>
                                <th>Vai trò</th>
                                <th>Trạng thái</th>
                                <th>
                                    <center>Chức năng</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allUser as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item['balance'], 0, ',', '.') }} VND</td>
                                    <td>{{ $item['role'] == 1 ? 'admin' : ($item['role'] == 2 ? 'Cộng tác viên' : ($item['role'] == 3 ? 'Bị chặn' : 'Người mua')) }}
                                    </td>
                                    <td>
                                        @if ($item->deleted_at)
                                            <h5><span class="badge badge-pill badge-danger">Vô hiệu hoá</span></h5>
                                        @else
                                            <h5><span class="badge badge-pill badge-success">Đang sử dụng</span></h5>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($item->deleted_at)
                                            <a class="btn btn-success" href="{{ route('admin.user.changeStatus', ['id' => $item->id]) }}">
                                                Khôi phục
                                            </a>
                                        @else
                                            <a class="btn btn-warning" href="{{ route('admin.user.editView', ['id' => $item->id]) }}">
                                                Sửa
                                            </a>
                                            <a class="btn btn-danger" href="{{ route('admin.user.changeStatus', ['id' => $item->id]) }}" onclick="return confirm('Bạn chắc chắn chứ?')">
                                                Vô hiệu hoá
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Họ và tên</th>
                                <th>Số dư hiện tại</th>
                                <th>Vai trò</th>
                                <th>Trạng thái</th>
                                <th>
                                    <center>Chức năng</center>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
