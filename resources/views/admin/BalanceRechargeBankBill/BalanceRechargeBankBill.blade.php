@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Hóa đơn giao dịch nạp tiền qua ngân hàng</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table-bordered table" width="100%" cellspacing="0">
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
                        </tfoot>
                        <tbody>
                            @foreach ($allBalanceRechargeBankBill as $index => $bill)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bill->User->username }}</td>
                                    <td>{{ $bill->bank }}</td>
                                    <td>{{ number_format($bill->amount) }} VNĐ</td>
                                    <td>{{ number_format($bill->balance_before) }} VNĐ</td>
                                    <td>{{ number_format($bill->balance_after) }} VNĐ</td>
                                    <td>{{ $bill->description ?? 'Không có' }}</td>
                                    <td>{{ $bill->status == 1 ? 'Thành công' : 'Thất bại' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
