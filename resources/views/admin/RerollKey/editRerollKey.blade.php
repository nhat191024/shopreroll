@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Sửa Reroll Key - {{ $rerollPackageName }}</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.rerollKey.update', $key->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="keyInput">Tên Reroll Key</label>
                            <input id="keyInput" class="form-control" name="key" type="text" required value="{{ old('key', $key->key ?? '') }}" maxlength="255" placeholder="Nhập key">
                        </div>
                        <input name="package_id" type="text" value="{{ $rerollPackage }}" hidden>
                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <button class="btn btn-success mt-4" type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
