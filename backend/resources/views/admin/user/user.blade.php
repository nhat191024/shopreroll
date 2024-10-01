@extends('admin.master01')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="">Thêm tài khoản</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Username</th>
                                    <th>Số dư</th>
                                    <th>Quyền</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Username</th>
                                    <th>Số dư</th>
                                    <th>Quyền</th>
                                    <th>Chức năng</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allUser as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item['balance'] }}</td>
                                        <td>{{ $item['role'] == 1 ? 'admin' : ($item['role'] == 2 ? 'Cộng tác viên' : 'Người mua') }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-warning" href="{{route('admin.user.editView',['id'=>$item->id])}}">Sửa</a>
                                            <a class="btn btn-danger" href="" 
                                            onclick="confirm('Bạn chắc chắn chứ?')"> Xóa </a>
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
