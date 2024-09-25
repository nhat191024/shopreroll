@extends('admin.master01')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Danh sách Reroll Category</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ route('admin.reroll_category.show_add') }}">Thêm Reroll Category</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <strong>#</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <strong>#</strong>
                            </div>
                        @endif
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã RC</th>
                                    <th class="col-2">Tên Reroll Category</th>
                                    <th class="col-3">Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Ảnh</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Mã RC</th>
                                    <th class="col-2">Tên Reroll Category</th>
                                    <th class="col-3">Ghi chú</th>
                                    <th>Trạng thái</th>
                                    <th>Ảnh</th>
                                <th>Chức năng</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allRerollCategory as $key => $item)
                                    <tr>
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['note'] }}</td>
                                        <td>{{ $item['status'] }}</td>
                                        <td class="text-center"><img width="200px" src="/img/product/{{ $item['image'] }}"
                                                alt=""></td>
                                        <td class="text-center">
                                            {{-- @if (!$item->deleted_at) --}}
                                                <a class="btn btn-danger"
                                                    onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn sản phẩm # chứ?')) { window.location.href = '#'; }">
                                                    Xóa </a>
                                            {{-- @endif --}}
                                            {{-- @if ($item->deleted_at) --}}
                                                <a class="btn btn-info"
                                                    onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hiện sản phẩm # chứ?')) { window.location.href = '#'; }">
                                                    Sửa </a>
                                            {{-- @endif --}}
                                            <a class="btn btn-info"
                                                href="#">Chi tiết</a>
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
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "ordering": false // Tắt tính năng tự động sắp xếp
            });
        });
    </script>
    <!-- End of Content Wrapper -->
@endsection