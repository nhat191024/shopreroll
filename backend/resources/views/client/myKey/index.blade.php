@extends('client.layouts.master')
@section('main')
    <section class="content">
        <div class="container-fluid">
            <center>
                <img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" class="city__icon">
            </center>
            <h1 class="guide__title">Key bought</h1>
            <main>
                <div>
                    <!-- Default box -->
                    <div class="card offset-lg-1 col-lg-10">
                        <div class="mt-3 px-5 pt-3 table-responsive">
                            <button id="raw-button" class="btn btn-sm btn-primary mb-3">Xem giản lược</button>
                            {{-- <input type="hidden" id="raw-content"
                                    value="@foreach ($keys as $item)- {{ $item->key }}&#10; @endforeach">
                                <textarea id="raw-textarea" rows="10" class="form-control" style="display: none; text-align: left;" readonly></textarea> --}}
                            <table id="user_data" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Key</th>
                                        <th>Thông tin</th>
                                        <th>Mua lúc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keys as $key => $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->key }}</td>
                                            <td>
                                                <b>{{ $item->rerollPackage }}</b>
                                                </br>
                                                Giá: {{ number_format($item->price, 0, ',') }} VNĐ
                                            </td>
                                            <td>{{ $item->purchased_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </main>
        </div>
        </body>

        </html>
    @endsection
