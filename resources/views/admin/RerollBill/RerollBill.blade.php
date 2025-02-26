@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Hóa đơn</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>

                                    <th>User</th>
                                    <th>Package</th>
                                    <th>key</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>User</th>
                                    <th>Package</th>
                                    <th>key</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allRerollBill as $index => $bill)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a class="btn btn-light"
                                            href="{{ route('admin.user.editView', ['id' => $bill->user_id]) }}">
                                             Thông tin User {{ $bill->user_id }}
                                         </a></td>
                                        <td><a class="btn btn-light"
                                            href="{{ route('admin.RerollPackage.showEdit', $bill->reroll_package_id) }}">Thông tin Package {{ $bill->reroll_package_id }}</a></td>
                                            <td><a class="btn btn-light"
                                                href="{{ route('admin.RerollKey.ShowEdit', ['idPackage' => $bill->reroll_package_id, 'idKey' => $bill->reroll_key_id]) }}">Thông tin Key {{ $bill->reroll_key_id }}</a></td>
                                        <td>{{ $bill->price }}</td>
                                        <td>{{ $bill->status == 1?"Thành công": "Thất bại" }}
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
