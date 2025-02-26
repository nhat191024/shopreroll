@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Nạp game</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ route('admin.GameRecharge.showAdd') }}">Thêm</a>
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
                                    <th style="width: 2%;">STT</th>
                                    <th style="width: 10%;">Trò chơi</th>
                                    <th style="width: 25%;">Hướng dẫn</th>
                                    <th>ID Youtube</th>
                                    <th style="width: 30%;">Ảnh</th>
                                    <th style="width: 7%;">Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
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
                            <tbody>
                                @foreach ($allGameRecharge as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['tutorial'] }}</td>
                                        <td>{{ $item['id_youtube'] }}</td>
                                        <td><img width="100%" src="{{ url('image/thumb') . '/' . $item->image }}"
                                                alt=""></td>
                                        <td>{{ $item['status'] == 1 ? 'Hoạt động' : 'Đã ẩn' }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning"
                                                href="{{ route('admin.GameRecharge.showEdit', ['id' => $item->id]) }}">
                                                Sửa
                                            </a>
                                            @if ($item->status == 0)
                                                <a class="btn btn-success"
                                                    onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hiện item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.GameRecharge.ChangeGameRechargeStatus', [$item->id, 1]) }}'; }">
                                                    Hiện </a>
                                            @else
                                                <a class="btn btn-danger"
                                                    onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.GameRecharge.ChangeGameRechargeStatus', [$item->id, 0]) }}'; }">
                                                    Ẩn </a>
                                            @endif

                                            <a class="btn btn-primary"
                                                href="{{ route('admin.GameRechargePackage.index', $item->id) }}">
                                                Packages
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
@endsection
