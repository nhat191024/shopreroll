@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <div class="d-flex justify-content-between mb-2">
            <h1 class="h3 mb-2 text-gray-800">Sửa tài khoản {{ $game->name }} id số {{ $game->id }}</h1>
            <a class="btn btn-secondary" href="{{ route('admin.game_account.index', $game->id) }}">Quay lại</a>
        </div>

        <div class="card mb-4 shadow">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <form action="{{ route('admin.game_account.update', $account->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p class="h5">- Thông tin cơ bản:</p>
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="">Tiêu đề</label>
                                <input class="form-control" name="title" type="text" value="{{ old('title', $account->title) }}" placeholder="Nhập tiêu đề">
                            </div>
                            <div class="form-group">
                                <label for="game_category">Chọn danh mục game</label>
                                <select id="game_category" class="form-control selectpicker" name="game_category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }} ">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tên đăng nhập</label>
                                <input class="form-control" name="username" type="text" value="{{ old('username', $account->username) }}" placeholder="Tên đăng nhập">
                            </div>
                            <div class="form-group">
                                <label for="">Mật khẩu</label>
                                <input class="form-control" name="password" type="text" value="{{ old('password', $account->password) }}" placeholder="Mật khẩu sẽ được mã hóa an toàn">
                            </div>
                            <div class="form-group">
                                <label for="price_in">Giá nhập khẩu</label>
                                <input class="form-control" name="price_in" type="number" value="{{ old('price_in', $account->price_in) }}" placeholder="Nếu để trống sẽ tự động coi là 0đ">
                            </div>
                            <div class="form-group">
                                <label for="price_out">Giá bán</label>
                                <input class="form-control" name="price_out" type="number" value="{{ old('price_out', $account->price_out) }}" placeholder="Nhập giá khách mua">
                            </div>
                            <div class="form-group">
                                <label for="account_image">Ảnh</label>
                                <div class="custom-file">
                                    <input id="account_image" class="custom-file-input" name="account_images[]" type="file" accept="image/*" multiple>
                                    <label class="custom-file-label" for="account_image">Chọn ảnh</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes">Ghi chú</label>
                                <textarea class="form-control" name="note" rows="4" placeholder="Ghi chú về tài khoản game">{{ old('note', $account->note) }}</textarea>
                            </div>
                        </div>
                        <!-- Right Column -->
                        <div class="col-md-4">
                            <p class="h6">- Ảnh preview:</p>
                            <div id="image_thumbnails" class="row">
                                @foreach ($account->AccountImage as $image)
                                    <div class="col-4 mb-3">
                                        <img class="img-fluid img-thumbnail" src="{{ asset($image->image) }}" style="object-fit: contain;">
                                    </div>
                                @endforeach
                            </div>
                            <nav>
                                <ul id="pagination" class="pagination justify-content-center mt-3"></ul>
                            </nav>
                        </div>
                    </div>

                    <p class="h5">- Thông tin chi tiết:</p>
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            @foreach ($itemTypes as $itemType)
                                <div class="form-group">
                                    <label for="game_item_{{ $itemType->id }}">{{ $itemType->name }}</label>
                                    <select id="game_item_{{ $itemType->id }}" class="form-control selectpicker" name="game_items[{{ $itemType->id }}][]" data-live-search="true" multiple>
                                        @foreach ($itemType->gameItems as $item)
                                            <option value="{{ $item->id }}" @selected(in_array($item->id, $accountItems))>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                        <!-- Right Column -->
                        <div class="col-md-6">
                            @foreach ($gameAttributes as $id => $name)
                                <div class="form-group">
                                    <label for="">{{ $name }}</label>
                                    <input class="form-control" name="game_attributes[{{ $id }}][]" type="text" value="{{ $account->AccountAttribute->where('game_attribute_id', $id)->first()->value ?? '' }}" placeholder="Nhập {{ $name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-success mt-4" type="submit">Cập nhật tài khoản game</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Display existing images with pagination
            let existingImages = @json($account->AccountImage->pluck('image'));
            let imagesPerPage = 9;
            let currentPage = 1;

            // Initialize pagination for existing images
            if (existingImages.length > 0) {
                let totalPages = Math.ceil(existingImages.length / imagesPerPage);
                renderPagination(totalPages, currentPage);

                // Add click handler for pagination
                $('#pagination').on('click', 'a', function(e) {
                    e.preventDefault();
                    currentPage = parseInt($(this).text());
                    let start = (currentPage - 1) * imagesPerPage;
                    let end = start + imagesPerPage;

                    $('#image_thumbnails').empty();
                    existingImages.slice(start, end).forEach(function(image) {
                        $('#image_thumbnails').append(
                            '<div class="col-4 mb-3"><img src="' + '{{ asset('') }}' + image + '" class="img-fluid img-thumbnail" style="width: 220px; height: 220px; object-fit: contain;"></div>'
                        );
                    });

                    renderPagination(totalPages, currentPage);
                });
            }

            // Custom file input handling
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);

                // Image preview handling
                let files = Array.from($(this)[0].files);
                let totalPages = Math.ceil(files.length / imagesPerPage);
                currentPage = 1;

                function renderImages(page) {
                    $('#image_thumbnails').empty();
                    let start = (page - 1) * imagesPerPage;
                    let end = start + imagesPerPage;
                    files.slice(start, end).forEach(function(file) {
                        let reader = new FileReader();
                        reader.onload = function(e) {
                            $('#image_thumbnails').append(
                                '<div class="col-4 mb-3"><img src="' + e.target.result + '" class="img-fluid img-thumbnail" style="width: 220px; height: 220px; object-fit: contain;"></div>'
                            );
                        }
                        reader.readAsDataURL(file);
                    });
                }

                renderImages(currentPage);
                renderPagination(totalPages, currentPage);

                // When new files are selected, replace pagination handler
                $('#pagination').off('click', 'a').on('click', 'a', function(e) {
                    e.preventDefault();
                    currentPage = parseInt($(this).text());
                    renderImages(currentPage);
                    renderPagination(totalPages, currentPage);
                });
            });

            function renderPagination(totalPages, currentPage) {
                $('#pagination').empty();
                for (let i = 1; i <= totalPages; i++) {
                    $('#pagination').append(
                        '<li class="page-item' + (i === currentPage ? ' active' : '') + '"><a class="page-link" href="#">' + i + '</a></li>'
                    );
                }
            }
        });
    </script>
@endsection
