@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Thêm tài khoản</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <a class="btn btn-primary" href="{{ route('admin.gameAccount.showAddForm') }}">Thêm tài khoản</a>
                    </div>
                    <div>
                        <!-- Form lọc danh mục -->
                        <form action="{{ route('admin.gameAccount.index') }}" method="GET" class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="filterCategory" class="sr-only">Danh mục</label>
                                <select class="form-control" id="filterCategory" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    @foreach ($gameCategories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }} ({{ $category->Game->name}})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success mb-2">Lọc</button>
                        </form>
                    </div>
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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Danh mục</th>
                                    <th>Tên tài khoản</th>
                                    <th>AR</th>
                                    <th>Server</th>
                                    <th>Giá bán</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Danh mục</th>
                                    <th>Tên tài khoản</th>
                                    <th>AR</th>
                                    <th>Server</th>
                                    <th>Giá bán</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $key = 0;
                                @endphp
                                @foreach ($gameAccounts as $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->gameCategory->name ?? 'Không có danh mục' }}</td>
                                        <td>{{ $item->username ?? 'Không có tên tài khoản' }}</td>
                                        <td>{{ $item->AR ?? 'N/A' }}</td>
                                        <td>{{ $item->server ?? 'N/A' }}</td>
                                        <td>{{ number_format($item->price_out) }} VND</td>
                                        <td>{{ $item->status == 1 ? 'Hoạt động' : 'Đã ẩn' }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning"
                                                href="{{ route('admin.GameRechargePackage.showEdit', ['id' => $item->id]) }}">
                                                Sửa
                                            </a>
                                            <a class="btn btn-danger"
                                                onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn xóa item {{ $item->username }} chứ?')) { window.location.href = '{{ route('admin.GameRechargePackage.ChangeGameRechargePackageStatus', [$item->id, 1]) }}'; }">
                                                Xóa
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
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
@endsection
