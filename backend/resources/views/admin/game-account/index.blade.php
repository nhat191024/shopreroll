@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Danh sách Acc Game</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ route('admin.gameAccount.show_add') }}">Thêm Acc</a>

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
                                    <th>Danh mục game</th>
                                    <th>AR</th>
                                    <th>Server</th>
                                    <th>Giá nhập khẩu</th>
                                    <th>Giá bán</th>
                                    <th>Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục game</th>
                                    <th>AR</th>
                                    <th>Server</th>
                                    <th>Giá nhập khẩu</th>
                                    <th>Giá bán</th>
                                    <th>Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Hành Động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($gameAccounts as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->GameCategory->name }}</td>
                                        <td>{{ $item->AR }}</td>
                                        <td>{{ $item->server }}</td>
                                        <td>{{ $item->price_in }}</td>
                                        <td>{{ $item->price_out }}</td>
                                        <td>{{ $item->note }}</td>
                                        <td>{{ $item->status == 0 ? 'Đã bị khoá' : 'Mở' }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning" href="{{ route('admin.gameAccount.show_edit', ['id' => $item->id]) }}">
                                                Sửa
                                            </a>
                                            <button class="btn btn-outline-danger" onclick="confirmSold({{ $item->id }}, '{{ $item->code }}')">
                                                Đã bán
                                            </button>
                                            <a class="btn btn-info" href="{{ route('admin.gameAccount.show_detail', ['id' => $item->id]) }}">
                                                Chi tiết
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



    </div>
    <!-- End of Content Wrapper -->
    <script>
        function confirmDelete(id, code) {
            if (confirm('Bạn chắc chắn muốn đánh dấu acc này là đã bán: ' + code + ' chứ?')) {
                window.location.href = "{{ route('admin.gameAccount.delete', ['id' => ':id']) }}".replace(':id', id);
            }
        }
    </script>
@endsection
