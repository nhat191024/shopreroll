@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Hóa đơn</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table-bordered table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Người mua</th>
                                <th>Package</th>
                                <th>key</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rerollBills as $key => $bill)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $bill->Buyer->username }}</td>
                                    <td>{{ $bill->RerollPackage->name }}</td>
                                    <td>{{ $bill->RerollKey->key }}</td>
                                    <td>{{ number_format($bill->price) }} VNĐ</td>
                                    <td>{{ $bill->status == 1 ? 'Thành công' : 'Thất bại' }}
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Người mua</th>
                                <th>Package</th>
                                <th>key</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
