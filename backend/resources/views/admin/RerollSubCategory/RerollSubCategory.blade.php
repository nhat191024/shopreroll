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
                    <a class="btn btn-primary" href="{{ route('admin.reroll_sub_category.show_add') }}">Thêm Reroll Sub Category</a>
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
                                    <th class="col-2">Tên Reroll Sub Category</th>
                                    <th class="col-3">Hướng dẫn</th>
                                    <th>Ảnh</th>
                                <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Mã</th>
                                    <th class="col-2">Tên Reroll Sub Category</th>
                                    <th class="col-3">Hướng dẫn</th>
                                    <th>Ảnh</th>
                                <th>Chức năng</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allRerollSubCategory as $key => $item)
                                @if ($item->status ==0)
                                    <tr>
                                        <td>{{ $item['id'] }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['tutorial'] }}</td>
                                        <td class="text-center"><img width="200px" src="{{ asset('image/thumb/' . $item['image']) }}"
                                                alt=""></td>
                                        <td class="text-center">
                                            {{-- @if (!$item->deleted_at) --}}
                                                <a class="btn btn-danger"
                                                    onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn xóa item {{$item['id']}} chứ?')) { window.location.href = '{{ route('admin.reroll_sub_category.delete', ['id' => $item->id]) }}'; }">
                                                    Ẩn </a>
                                            {{-- @endif --}}
                                            {{-- @if ($item->deleted_at) --}}
                                                <a class="btn btn-info"
                                                    onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn sửa item {{$item['id']}} chứ?')) { window.location.href = '{{ route('admin.reroll_sub_category.show_edit', ['id' => $item->id]) }}'; }">
                                                    Sửa </a>
                                            {{-- @endif --}}
                                        </td>

                                    </tr>
                                @endif
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