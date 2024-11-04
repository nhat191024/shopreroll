@extends('admin.master')
@section('main')
    <div class="container-fluid">

        <h1 class="h3 mb-2 text-gray-800">Chỉnh sửa tài khoản game</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <!-- Phần hiển thị lỗi -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.gameAccount.edit', $gameAccount->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Tiêu đề</label>
                                <input required type="text" class="form-control" name="title"
                                    value="{{ $gameAccount->title }}" placeholder="Nhập tiêu đề">
                            </div>

                            <div class="form-group">
                                <label for="">Tên đăng nhập</label>
                                <input required type="text" class="form-control" name="username"
                                    value="{{ $gameAccount->username }}" placeholder="Tên đăng nhập">
                            </div>

                            <div class="form-group">
                                <label for="server">Server</label>
                                <select class="form-control" id="server" name="server">
                                    <option value="ASIA" {{ $gameAccount->server == 'ASIA' ? 'selected' : '' }}>ASIA
                                    </option>
                                    <option value="EUROPE" {{ $gameAccount->server == 'EUROPE' ? 'selected' : '' }}>EUROPE
                                    </option>
                                    <option value="AMERICA" {{ $gameAccount->server == 'AMERICA' ? 'selected' : '' }}>
                                        AMERICA</option>
                                    <option value="TW" {{ $gameAccount->server == 'TW' ? 'selected' : '' }}>TW</option>
                                    <option value="HK" {{ $gameAccount->server == 'HK' ? 'selected' : '' }}>HK</option>
                                    <option value="MO" {{ $gameAccount->server == 'MO' ? 'selected' : '' }}>MO</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="hero">Tướng</label>
                                <select class="form-control" id="hero" name="hero_id">
                                    <!-- Heroes options sẽ được cập nhật qua JavaScript -->
                                    <option value="{{ $gameAccount->hero_id }}" selected>
                                        {{ $gameAccount->hero->name ?? 'Chọn Tướng' }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price_in">Giá nhập khẩu</label>
                                <input type="number" class="form-control" name="price_in"
                                    value="{{ $gameAccount->price_in }}" placeholder="Nếu để trống sẽ tự động coi là 0đ">
                            </div>

                            <div class="form-group">
                                <label for="account_image">Ảnh</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="account_image" name="account_image">
                                    <label class="custom-file-label" for="account_image">Chọn ảnh</label>
                                </div>
                                @if ($gameAccount->account_image)
                                    <img src="{{ asset('storage/' . $gameAccount->account_image) }}" alt="Account Image"
                                        class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mật khẩu</label>
                                <input required type="password" class="form-control" name="password"
                                    value="{{ $gameAccount->password }}" placeholder="Mật khẩu sẽ được mã hóa an toàn">
                            </div>

                            <div class="form-group">
                                <label for="ar">AR</label>
                                <input required type="number" class="form-control" name="ar"
                                    value="{{ $gameAccount->ar }}" placeholder="Nhập AR">
                            </div>

                            <div class="form-group">
                                <label for="game_category">Chọn danh mục game</label>
                                <select class="form-control" id="game_category" name="game_category_id">
                                    @foreach ($gameCategories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $gameAccount->game_category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }} ({{ $category->Game->name }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="weapon">Vũ khí</label>
                                <select class="form-control" id="weapon1" name="weapon_id">
                                    <!-- Weapons options sẽ được cập nhật qua JavaScript -->
                                    <option value="{{ $gameAccount->weapon_id }}" selected>
                                        {{ $gameAccount->weapon->name ?? 'Chọn Vũ Khí' }}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price_out">Giá bán</label>
                                <input required type="number" class="form-control" name="price_out"
                                    value="{{ $gameAccount->price_out }}" placeholder="Nhập giá khách mua">
                            </div>

                            <div class="form-group">
                                <label for="notes">Ghi chú</label>
                                <textarea required class="form-control" name="note" rows="4" placeholder="Ghi chú về tài khoản game">{{ $gameAccount->note }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success mt-4" type="submit">Cập nhật tài khoản game</button>
                </form>
            </div>
        </div>
    </div>
@endsection
