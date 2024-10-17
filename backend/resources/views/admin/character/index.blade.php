@extends('admin.master')
@section('main')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">



        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h1 class="h3 mb-2 text-gray-800">Danh sách nhân vật : {{ $game_name }}</h1>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 2%;">STT</th>
                                    <th style="width: 30%;">Tên nhân vật</th>
                                    <th style="width: 50%;">Ảnh</th>
                                    <th style="width: 20%;">Ngày cập nhập</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th style="width: 2%;">STT</th>
                                    <th style="width: 30%;">Tên nhân vật</th>
                                    <th style="width: 50%;">Ảnh</th>
                                    <th style="width: 20%;">Ngày cập nhập</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($characters as $key => $character)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $character['name'] }}</td>
                                        <td><img width="10%" src="{{ $character['image'] }}" alt=""></td>
                                        <td>{{\Carbon\Carbon::parse($date->updated_at)->format('d-m-Y')}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->



    </div>
    <!-- End of Content Wrapper -->
@endsection
