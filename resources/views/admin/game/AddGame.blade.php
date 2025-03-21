@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Thêm trò chơi</h1>

        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form class="form" action="{{ route('admin.game.add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên trò chơi</label>
                            <input id="" class="form-control" name="name" type="text" required>
                        </div>
                        <div class="game-item">
                            <div class="form-group mb-3">
                                <label for="">Tên game item</label>
                                <input id="" class="form-control" name="game_item[]" type="text" required aria-describedby="game-item-name">
                            </div>
                        </div>
                        <button class="btn btn-success mt-4" type="submit">Thêm trò chơi</button>
                        <button id="add-game-item-btn" class="btn btn-success mt-4" type="button">Thêm game item</button>
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
