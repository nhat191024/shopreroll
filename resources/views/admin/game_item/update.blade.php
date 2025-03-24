@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Sửa vật phẩm {{ $gameItem->name }}</h1>

        <div class="card mb-4 shadow">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Lôi xảy ra, vui lòng kiểm tra lại thông tin nhập vào
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="table-responsive">
                    <form class="form" action="{{ route('admin.game_item.update', $gameItem->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Tên</label>
                            <input id="" class="form-control" name="name" type="text" value="{{ $gameItem->name }}" aria-describedby="game-item-name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Mô tả</label>
                            <textarea id="" class="form-control" name="description" aria-describedby="game-item-description">{{ $gameItem->description }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Loại</label>
                            <select id="" class="form-control" name="game_item_type_id" aria-describedby="game-item-type">
                                @foreach ($itemTypes as $item)
                                    <option value="{{ $item->id }}" {{ $gameItem->game_item_type_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Ảnh</label>
                            <input id="form-control-file" class="form-control-file" name="image" type="file" aria-describedby="game-item-image">
                        </div>

                        <button class="btn btn-success mt-4" type="submit">Xác nhận</button>
                        <a class="btn btn-primary mt-4" href="{{ route('admin.game_item.index', $gameItem->game_id) }}">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
