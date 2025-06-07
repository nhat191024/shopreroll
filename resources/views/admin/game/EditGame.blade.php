@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Sửa trò chơi</h1>

        <div class="card mb-4 shadow">
            <div class="card-body">
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
                <div class="table-responsive">
                    <form class="form" action="{{ route('admin.game.update', $game->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên trò chơi</label>
                            <input id="" class="form-control" name="name" type="text" required value="{{ $game->name }}">
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="game-item col-sm">
                                    @foreach ($game->gameItemType as $item)
                                        <div class="form-group mb-3">
                                            <label for="">Tên game item</label>
                                            <input id="" class="form-control" name="game_item[]" type="text" required value="{{ $item->name }}" aria-describedby="game-item-name">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="game-attribute col-sm">
                                    @foreach ($game->gameAttribute as $item)
                                        <div class="form-group mb-3">
                                            <label for="">Tên thuộc tính</label>
                                            <input id="" class="form-control" name="game_attribute[]" type="text" required value="{{ $item->name }}" aria-describedby="game-attribute-name">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="float-left mt-4">
                            <button class="btn btn-success" type="submit">Xác nhận</button>
                            <a class="btn btn-warning" href="{{ route('admin.game.index') }}">Quay lại</a>
                        </div>
                        <div class="float-right mt-4">
                            <button id="add-game-item-btn" class="btn btn-success" type="button">Thêm game item</button>
                            <button id="add-game-attribute-btn" class="btn btn-success" type="button">Thêm thuộc tính</button>
                        </div>
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

        $("#add-game-attribute-btn").click(function() {
            var html = `
                <div class="form-group mb-3">
                    <label for="">Tên thuộc tính</label>
                    <div class="input-group">
                        <input id="" class="form-control" name="game_attribute[]" type="text" required aria-describedby="game-attribute-name">
                        <div class="input-group-append">
                            <button id="rm-btn-${i}" class="btn btn-outline-danger" type="button">Xóa</button>
                        </div>
                    </div>
                </div>
            `;
            $(".game-attribute").append(html);
            i++;
        });
    </script>
@endsection
