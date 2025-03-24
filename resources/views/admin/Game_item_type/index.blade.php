@extends('admin.master')
@section('main')
    <div id="content-wrapper" class="d-flex flex-column">
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Danh sách loại vật phẩm trong {{ $gameName }}</h1>
            <div class="card mb-4 shadow">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ url()->previous() }}">Quay lại</a>
                    <a class="btn btn-primary" href="{{ route('admin.game_item_type.create', [$gameId]) }}">Thêm loại vật phẩm cho game</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <table id="dataTable" class="cell-border table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên loại vật phẩm</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gameItemTypes as $key => $item)
                                    <tr>
                                        <td style="width: 5%;">{{ ++$key }}</td>
                                        <td style="width: 30%;">{{ $item['name'] }}</td>
                                        <td style="width: 20%;">
                                            <a class="btn btn-primary" href="{{ route('admin.game_item_type.edit', [$item->id]) }}">Sửa</a>
                                            <a class="btn btn-danger" href="{{ route('admin.game_item_type.destroy', [$item->id]) }}">Xóa</a>
                                            <button class="btn btn-primary">Danh sách vật phẩm</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên loại vật phẩm</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
