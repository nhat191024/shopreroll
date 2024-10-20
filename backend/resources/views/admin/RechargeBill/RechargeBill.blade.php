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
                                    <th>UID</th>
                                    <th>Username</th>
                                    <th>Server</th>
                                    <th>Character Name</th>
                                    <th>Gói nạp</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>UID</th>
                                    <th>Username</th>
                                    <th>Server</th>
                                    <th>Character Name</th>
                                    <th>Gói nạp</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allRechargeBill as $index => $bill)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $bill->UID }}</td>
                                        <td>{{ $bill->username }}</td>
                                        <td>{{ $bill->server }}</td>
                                        <td>{{ $bill->character_name }}</td>
                                        <td>{{ $bill->RechargePackage->name }}</td>
                                        <td>{{ $bill->RechargePackage->price }}</td>
                                        <td>{{ $bill->status == 1 ? 'Đã Thanh Toán' : 'Chưa Thanh Toán' }}</td>
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
