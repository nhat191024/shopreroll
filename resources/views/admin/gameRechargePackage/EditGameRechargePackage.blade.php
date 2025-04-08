@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Sửa gói nạp trò chơi</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.gameRechargePackage.update', $package->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên gói nạp</label>
                            <input id="" class="form-control" name="name" type="text" required value="{{ $package->name }}" aria-describedby="" placeholder="Nhập tên gói nạp">
                        </div>
                        <div class="form-group">
                            <label for="">Giá trị gói nạp</label>
                            <input id="" class="form-control" name="price" type="number" required value="{{ $package->price }}" aria-describedby="" placeholder="Nhập giá trị gói nạp" min="1" max="9999999">
                        </div>
                        <div class="form-group">
                            <label for="game_recharge_id">Chọn trò chơi</label>
                            <select id="game_recharge_id" class="form-control" name="game_recharge_id">
                                @foreach ($gameRecharges as $item)
                                    <option value="{{ $item->id }}" {{ $item['id'] == $package->game_recharge_id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <a class="btn btn-primary mt-4" href="{{ route('admin.gameRechargePackage.index', $package->game_recharge_id) }}">Quay lại</a>
                        <button class="btn btn-success mt-4" type="submit">Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
