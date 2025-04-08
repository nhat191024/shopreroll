@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Hóa đơn nạp thẻ</h1>
        <!-- DataTales Example -->
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table-bordered table" width="100%" cellspacing="0">
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
                        <tbody>
                            @foreach ($allBalanceRechargeCardBill as $index => $bill)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bill->User->username}}</td>
                                    <td>{{ $bill->number }}</td>
                                    <td>{{ $bill->serial }}</td>
                                    <td>{{ $bill->mobile_carrier }}</td>
                                    <td>{{ number_format($bill->amount_fake) }} VNĐ</td>
                                    <td>{{ number_format($bill->amount_real) }} VNĐ</td>
                                    <td>{{ number_format($bill->balance_added) }} VNĐ</td>
                                    <td>{{ $bill->status == 1 ? 'Thành công' : 'Thất bại' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
