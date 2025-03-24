@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Thêm thuộc tính cho {{ $gameName }}</h1>

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
                    <form class="form" action="{{ route('admin.game_attribute.store', [$gameId]) }}" method="post">
                        @csrf
                        <div class="game-attribute">
                            <div class="form-group mb-3">
                                <label for="">Tên thuộc tính</label>
                                <input id="" class="form-control" name="game_attribute[]" type="text" aria-describedby="game-item-attribute">
                            </div>
                        </div>

                        <input name="game_id" type="hidden" value="{{ $gameId }}">

                        <button class="btn btn-success mt-4" type="submit">Xác nhận</button>
                        <button id="add-game-item-btn" class="btn btn-success mt-4" type="button">Thêm thuộc tính</button>
                        <a class="btn btn-primary mt-4" href="{{ route('admin.game_attribute.index', [$gameId]) }}">Quay lại</a>
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
                    <label for="">Tên thuộc tính</label>
                    <div class="input-group">
                        <input id="" class="form-control" name="game_attribute[]" type="text" required aria-describedby="game-item-attribute">
                        <div class="input-group-append">
                            <button id="rm-btn-${i}" class="btn btn-outline-danger" type="button">Xóa</button>
                        </div>
                    </div>
                </div>
            `;
            $(".game-attribute").append(html);
            i++;
        });

        $(document).on('click', '[id^=rm-btn-]', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
@endsection
