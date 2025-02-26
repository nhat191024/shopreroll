@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Hóa đơn giao dịch nạp game</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách nạp</th>
                                    <th>Tên ngân hàng</th>
                                    <th>Giá trị</th>
                                    <th>Số dư trước giao dịch</th>
                                    <th>Số dư sau giao dịch</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách nạp</th>
                                    <th>Tên ngân hàng</th>
                                    <th>Giá trị</th>
                                    <th>Số dư trước giao dịch</th>
                                    <th>Số dư sau giao dịch</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allBalanceRechargeBankBill as $index => $bill)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $bill->User ? $bill->User->name : 'N/A' }}</td>
                                        <td>{{ $bill->bank }}</td>
                                        <td>{{ $bill->amount }}</td>
                                        <td>{{ $bill->balance_before }}</td>
                                        <td>{{ $bill->balance_after }}</td>
                                        <td>{{ $bill->description }}</td>
                                        <td>{{ $bill->status == 1 ? 'Thành công' : 'Thất bại' }}</td>
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
