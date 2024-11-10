@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Hóa đơn nạp thẻ</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách nạp</th>
                                    <th>Số thẻ</th>
                                    <th>Số serial</th>
                                    <th>Nhà mạng</th>
                                    <th>Giá trị nhập</th>
                                    <th>Giá trị thực</th>
                                    <th>Số tiền được cộng</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách nạp</th>
                                    <th>Số thẻ</th>
                                    <th>Số serial</th>
                                    <th>Nhà mạng</th>
                                    <th>Giá trị nhập</th>
                                    <th>Giá trị thực</th>
                                    <th>Số tiền được cộng</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($allBalanceRechargeCardBill as $index => $bill)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $bill->User ? $bill->User->name : 'N/A' }}</td>
                                        <td>{{ $bill->number }}</td>
                                        <td>{{ $bill->serial }}</td>
                                        <td>{{ $bill->mobile_carrier }}</td>
                                        <td>{{ $bill->amount_fake }}</td>
                                        <td>{{ $bill->amount_real }}</td>
                                        <td>{{ $bill->balance_added }}</td>
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
