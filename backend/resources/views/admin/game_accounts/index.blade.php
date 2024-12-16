@extends('admin.master')
@section('main')
    <!-- Modal Import Excel -->
    <div class="modal fade" id="importExcelModal" tabindex="-1" role="dialog" aria-labelledby="importExcelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.gameAccount.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importExcelModalLabel">Nhập tài khoản từ Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="excelFile">Chọn file Excel</label>
                            <input type="file" class="form-control" id="excelFile" name="excel_file"
                                accept=".xls,.xlsx,.csv" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Tải lên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <div>
                        <a class="btn btn-primary" href="{{ route('admin.gameAccount.showAddForm') }}">Thêm tài khoản</a>
                        <!-- Nút tải lên file Excel -->
                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                            data-target="#importExcelModal">
                            Nhập từ Excel
                        </button>
                    </div>
                    <div>
                        <!-- Form lọc danh mục và trạng thái -->
                        <form action="{{ route('admin.gameAccount.index') }}" method="GET" class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="filterCategory" class="sr-only">Danh mục</label>
                                <select class="form-control" id="filterCategory" name="category_id">
                                    <option value="">Tất cả</option>
                                    @foreach ($gameCategories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Thêm nút lọc trạng thái sản phẩm đã bán -->
                            <div class="form-group mx-sm-3 mb-2">
                                <select class="form-control" id="filterStatus" name="status">
                                    <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Đã bán</option>
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
                                    <th>Tiêu đề</th>
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
                                    <th>Tiêu đề</th>
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
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->gameCategory->name ?? 'Không có danh mục' }}</td>
                                        <td>{{ $item->username ?? 'Không có tên tài khoản' }}</td>
                                        <td>{{ $item->AR ?? 'N/A' }}</td>
                                        <td>{{ $item->server ?? 'N/A' }}</td>
                                        <td>{{ number_format($item->price_out) }} VND</td>
                                        <td>{{ $item->status == 1 ? 'Hoạt động' : 'Đã bán' }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning"
                                                href="{{ route('admin.gameAccount.edit', ['id' => $item->id]) }}">
                                                Chi tiết
                                            </a>
                                            <a class="btn btn-danger"
                                                onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn xóa hoàn toàn item {{ $item->username }} chứ?')) { window.location.href = '{{ route('admin.gameAccount.disable', ['id' => $item->id]) }}'; }">
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
