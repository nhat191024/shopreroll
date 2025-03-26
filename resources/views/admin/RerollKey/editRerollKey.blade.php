@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Sửa Reroll Key</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.rerollKey.edit', ['idPackage' => $idPackage, 'idKey' => $idKey]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="keyInput">Tên Reroll Key</label>
                            <input id="keyInput" class="form-control" name="key" type="text" required value="{{ old('key', $rerollKeyInfo->key ?? '') }}" maxlength="255" placeholder="Nhập key">
                        </div>
                        <input name="id" type="hidden" value="{{ $rerollKeyInfo->id }}">
                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <button id="saveEdit" class="btn btn-success mt-4" type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
