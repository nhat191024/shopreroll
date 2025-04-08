@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Sửa thuộc tính {{ $gameAttribute->name }}</h1>

        <div class="card mb-4 shadow">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        Lỗi xảy ra, vui lòng kiểm tra lại thông tin nhập vào
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="table-responsive">
                    <form class="form" action="{{ route('admin.game_attribute.update', $gameAttribute->id) }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="">Tên thuộc tính</label>
                            <input id="" class="form-control" name="name" type="text" value="{{ $gameAttribute->name }}" aria-describedby="game-item-attribute">
                        </div>

                        <button class="btn btn-success mt-4" type="submit">Xác nhận</button>
                        <a class="btn btn-primary mt-4" href="{{ route('admin.game_attribute.index', $gameAttribute->game_id) }}">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
