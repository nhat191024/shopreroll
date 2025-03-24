@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Thêm loại vật phẩm cho game {{ $gameName }}</h1>

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
                    <form class="form" action="{{ route('admin.game_item_type.store', [$gameId]) }}" method="post">
                        @csrf
                        <div class="game-item">
                            <div class="form-group mb-3">
                                <label for="">Tên game item</label>
                                <input id="" class="form-control" name="game_item[]" type="text" aria-describedby="game-item-name">
                            </div>
                        </div>

                        <input name="game_id" type="hidden" value="{{ $gameId }}">

                        <button class="btn btn-success mt-4" type="submit">Xác nhận</button>
                        <button id="add-game-item-btn" class="btn btn-success mt-4" type="button">Thêm game item</button>
                        <a class="btn btn-primary mt-4" href="{{ route('admin.game_item_type.index', [$gameId]) }}">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        var i = 0;
        $("#add-game-item-btn").click(function() {
            var html = `
                <div class="form-group mb-3">
                    <label for="">Tên game item</label>
                    <div class="input-group">
                        <input id="" class="form-control" name="game_item[]" type="text" required aria-describedby="game-item-name">
                        <div class="input-group-append">
                            <button id="rm-btn-${i}" class="btn btn-outline-danger" type="button">Xóa</button>
                        </div>
                    </div>
                </div>
            `;
            $(".game-item").append(html);
            i++;
        });

        $(document).on('click', '[id^=rm-btn-]', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
@endsection
