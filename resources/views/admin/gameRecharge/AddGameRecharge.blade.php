@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Thêm Game Recharge</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.gameRecharge.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên trò chơi</label>
                            <input id="" class="form-control" name="name" type="text" required aria-describedby="" placeholder="Nhập tên trò chơi">
                        </div>
                        <div class="form-group">
                            <label for="">Hướng dẫn</label>
                            <textarea id="" class="form-control" name="tutorial" required rows="4" placeholder="Nhập hướng dẫn"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">ID Youtube</label>
                            <input id="" class="form-control" name="id_youtube" type="text" aria-describedby="" placeholder="Nhập id video youtube">
                        </div>
                        <div class="form-group">
                            <label for="recharge_image">Ảnh</label>
                            <div class="custom-file">
                                <input id="image" class="custom-file-input" name="image" type="file">
                                <label class="custom-file-label" for="recharge_image">Chọn ảnh</label>
                            </div>
                        </div>
                        <a class="btn btn-secondary mt-4" href="{{ route('admin.gameRecharge.index') }}">Quay lại</a>
                        <button class="btn btn-success mt-4" type="submit">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
