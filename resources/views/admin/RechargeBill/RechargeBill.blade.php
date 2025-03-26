@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Hóa đơn</h1>>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table-bordered table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>UID</th>
                                <th>Tên khách nạp</th>
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
                                <th>Tên khách nạp</th>
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
                                    <td>{{ $bill->User ? $bill->User->name : 'N/A' }}</td>
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
@endsection
