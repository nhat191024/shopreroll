@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Sửa Reroll Key</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.rerollKey.edit', ['idPackage' => $idPackage, 'idKey' => $idKey]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="keyInput">Tên Reroll Key</label>
                            <input maxlength="255" required type="text" class="form-control" id="keyInput"
                                name="key" value="{{ old('key', $rerollKeyInfo->key ?? '') }}"
                                placeholder="Nhập key">
                        </div>
                        <input type="hidden" value="{{ $rerollKeyInfo->id }}" name="id">
                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <button id="saveEdit" class="btn btn-success mt-4" type="submit">Lưu</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- End of Content Wrapper -->
@endsection
