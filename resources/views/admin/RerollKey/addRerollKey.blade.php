@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Thêm Reroll Key</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.rerollKey.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="keyName">Reroll Key</label>
                            <input id="keyName" class="form-control" name="key" type="text" required maxlength="255" placeholder="Nhập Reroll Key">
                        </div>
                        <div class="form-group">
                            <label for="">Gói reroll</label>
                            <select class="form-control" name="package_id" required>
                                @foreach ($rerollPackage as $id => $item)
                                    <option value="{{ $id }}" @selected($id == $package)>{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <button id="saveAdd" class="btn btn-success mt-4" type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
