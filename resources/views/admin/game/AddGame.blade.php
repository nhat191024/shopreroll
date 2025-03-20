@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Thêm trò chơi</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.game.add') }}" method="post" enctype="multipart/form-data" class="form">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên trò chơi</label>
                            <input required type="text" class="form-control" id="" aria-describedby=""
                                name="name">
                        </div>
                        <div class="game-item">
                            <div class="form-group">
                                <label for="">Tên game item</label>
                                <input required type="text" class="form-control" id="" aria-describedby="game-item-name" name="game_item[]">
                            </div>
                        </div>
                        <button class="btn btn-success mt-4" type="submit">Thêm trò chơi</button>
                        <button class="btn btn-success mt-4" id="add-game-item-btn" type="button">Thêm game item</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $("#add-game-item-btn").click(function() {
            var html = `
            <div class="form-group">
                <label for="">Tên game item</label>
                <input required type="text" class="form-control" id="" aria-describedby="game-item-name" name="game_item[]">
            </div>
            `;
            $(".game-item").append(html);
        });
    </script>
@endsection
