@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Danh sách Reroll Key</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ route('admin.rerollKey.showAdd', ['idPackage' => $idPackage]) }}">Thêm Reroll Key</a>
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
                                    <th>ID</th>
                                    <th class="col-4">Key</th>
                                    <th class="col-3 text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th class="col-4">Key</th>
                                    <th class="col-3 text-center">Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allRerollKeys as $key => $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->key }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-danger"
                                            onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->id }} chứ?')) { window.location.href = '{{ route('admin.RerollKey.delete', ['idPackage' => $idPackage, 'idKey' => $item->id]) }}'; }">
                                            Xóa </a>
                                            <a class="btn btn-info" href="{{ route('admin.RerollKey.ShowEdit', ['idPackage' => $idPackage, 'idKey' => $item->id]) }}">Sửa</a>
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

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "ordering": false // Tắt tính năng tự động sắp xếp
            });
        });
    </script>
    <!-- End of Content Wrapper -->
@endsection
