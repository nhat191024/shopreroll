@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Thêm vật phẩm cho game {{ $gameName }}</h1>

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
                    <form class="form" action="{{ route('admin.game_item.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Tên</label>
                            <input id="" class="form-control" name="name" type="text" aria-describedby="game-item-name">
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Mô tả</label>
                            <textarea id="" class="form-control" name="description" aria-describedby="game-item-description"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Loại</label>
                            <select id="" class="form-control" name="game_item_type_id" aria-describedby="game-item-type">
                                @foreach ($itemTypes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="">Ảnh</label>
                            <input id="form-control-file" class="form-control-file" name="image" type="file" required aria-describedby="game-item-image">
                        </div>

                        <input name="game_id" type="hidden" value="{{ $gameId }}">

                        <button class="btn btn-success mt-4" type="submit">Xác nhận</button>
                        <a class="btn btn-primary mt-4" href="{{ route('admin.game_item.index', $gameId) }}">Quay lại</a>
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
