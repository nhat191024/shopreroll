@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản {{ $game->name }} - {{ $categoryName }}</h1>
        <div class="card mb-4 shadow">
            <div class="card-header d-flex align-items-center justify-content-between py-3">
                <div>
                    <a class="btn btn-primary" href="{{ route('admin.game_account.create', $game->id) }}">Thêm tài khoản</a>
                    <!-- Nút tải lên file Excel -->
                    <button class="btn btn-secondary" data-toggle="modal" data-target="#importExcelModal" type="button">
                        Nhập từ Excel
                    </button>
                </div>
                <div>
                    <!-- Form lọc danh mục và trạng thái -->
                    <form class="form-inline" action="{{ route('admin.game_account.index', $game->id) }}" method="GET">
                        <div class="form-group mx-sm-3 mb-2">
                            <label class="sr-only" for="filterCategory">Danh mục</label>
                            <select id="filterCategory" class="form-control" name="category_id">
                                <option value="">Tất cả</option>
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}" {{ request('category_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Thêm nút lọc trạng thái sản phẩm đã bán -->
                        <div class="form-group mx-sm-3 mb-2">
                            <select id="filterStatus" class="form-control" name="status">
                                <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Hoạt động</option>
                                <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>Đã bán</option>
                            </select>
                        </div>

                        <button class="btn btn-success mb-2" type="submit">Lọc</button>
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
                    <table id="dataTable" class="table-bordered table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Danh mục</th>
                                <th>Tên tài khoản</th>
                                <th>Giá bán</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accounts as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->gameCategory->name ?? 'Không có danh mục' }}</td>
                                    <td>{{ $item->username ?? 'Không có tên tài khoản' }}</td>
                                    <td>{{ number_format($item->price_out) }} VND</td>
                                    <td>{{ $item->status == 1 ? 'Hoạt động' : 'Đã bán' }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{ route('admin.game_account.edit', ['id' => $item->id]) }}">
                                            Chi tiết
                                        </a>
                                        <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn xóa hoàn toàn item {{ $item->username }} chứ?')) { window.location.href = '{{ route('admin.game_account.destroy', ['id' => $item->id]) }}'; }">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Danh mục</th>
                                <th>Tên tài khoản</th>
                                <th>Giá bán</th>
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
