@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Thêm gói nạp</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.gameRechargePackage.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Tên </label>
                            <input id="" class="form-control" name="name" type="text" required aria-describedby="" placeholder="Nhập tên">
                        </div>
                        <div class="form-group">
                            <label for="">Giá tiền</label>
                            <input id="" class="form-control" name="price" type="number" required aria-describedby="" placeholder="Nhập số tiền" min="1" max="9999999">
                        </div>
                        <div class="form-group">
                            <label for="">Game recharge</label>
                            <select id="" class="form-control" name="game_recharge_id">
                                @foreach ($gameRecharges as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-success mt-4" type="submit">Thêm gói nạp</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
