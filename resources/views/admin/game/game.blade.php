@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Danh sách game</h1>
        <div class="card mb-4 shadow">
            <div class="card-header py-3">
                <a class="btn btn-primary" href="{{ route('admin.game.show_add') }}">Thêm game</a>
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
                    <table id="dataTable" class="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên trò chơi</th>
                                <th>Số vật phẩm</th>
                                <th>Số thuộc tính</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Tên trò chơi</th>
                                <th>Số vật phẩm</th>
                                <th>Số thuộc tính</th>
                                <th>Trạng thái</th>
                                <th>Chức năng</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($games as $key => $item)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['game_item_type_count'] }}</td>
                                    <td>{{ $item['game_attribute_count'] }}</td>
                                    <td>{{ $item['status'] == 1 ? 'Hoạt động' : 'Đã ẩn' }}</td>
                                    <td style="width: 20%;">
                                        <a class="btn btn-warning" href="{{ route('admin.game.show_edit', ['id' => $item->id]) }}">
                                            Sửa
                                        </a>

                                        @if ($item->status == 0)
                                            <a class="btn btn-success" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn hiện item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.game.ChangeStatus', [$item->id, 1]) }}'; }">
                                                Hiện
                                            </a>
                                        @else
                                            <a class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Bạn chắc chắn muốn ẩn item {{ $item->name }} chứ?')) { window.location.href = '{{ route('admin.game.ChangeStatus', [$item->id, 0]) }}'; }">
                                                Ẩn
                                            </a>
                                        @endif

                                        <a class="btn btn-primary" href="{{ route('admin.GameCategory.index', $item->id) }}">
                                            Danh mục
                                        </a>

                                        <a class="btn btn-primary" href="{{ route('admin.game_item_type.index', $item->id) }}">
                                            Vật phẩm
                                        </a>

                                        <a class="btn btn-primary" href="{{ route('admin.game_item_type.index', $item->id) }}">
                                            Thuộc tính
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
@endsection
