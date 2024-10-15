@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Danh sách Reroll Package</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th class="col-2">Tên</th>
                                    <th class="col-3">Giá</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Mã</th>
                                    <th class="col-2">Tên</th>
                                    <th class="col-3">Giá</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allRerollPackages as $key => $item)
                                    <tr>
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['price'] }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-danger"
                                            onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.RerollPackage.delete', $item->id) }}'; }">
                                            Xóa </a>
                                            <a class="btn btn-info" href="{{ route('admin.RerollPackage.showEdit', $item->id) }}">Sửa</a>

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
