@extends('admin.master')
@section('main')
    <div id="content-wrapper" class="d-flex flex-column">
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Danh sách vật phẩm trong {{ $gameName }}</h1>
            <div class="card mb-4 shadow">
                <div class="card-header py-3">
                    <a class="btn btn-primary" href="{{ route('admin.game.index') }}">Quay lại</a>
                    <a class="btn btn-primary" href="{{ route('admin.game_item.create', [$gameId]) }}">Thêm vật phẩm cho game</a>
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

                        <table id="dataTable" class="table-bordered table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Ảnh</th>
                                    <th>Loại</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gameItems as $key => $item)
                                    <tr>
                                        <td style="width: 5%;">{{ ++$key }}</td>
                                        <td style="width: 15%;">{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td style="width: 15%;">
                                            <img src="{{ asset($item->image) }}" alt="{{ $item->name . ' Img' }}" style="width: 120px; height: 120px; object-fit: contain;">
                                        </td>
                                        <td style="width: 15%;">{{ $item->gameItemType->name }}</td>
                                        <td style="width: 15%;">
                                            <a class="btn btn-primary" href="{{ route('admin.game_item.edit', $item->id) }}">Sửa</a>
                                            <a class="btn btn-danger" href="{{ route('admin.game_item.destroy', $item->id) }}">Xóa</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Mô tả</th>
                                    <th>Ảnh</th>
                                    <th>Loại</th>
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
