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
                    <div class="card card-solid offset-lg-1 col-lg-10">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="mt-3 table-responsive">
                                    <button id="raw-button" class="btn btn-sm btn-primary mb-3">Xem giản lược</button>
                                    <input type="hidden" id="raw-content"
                                        value="@foreach ($keys as $item)- {{ $item->key }}&#10; @endforeach">
                                    <textarea id="raw-textarea" rows="10" class="form-control" style="display: none; text-align: left;" readonly></textarea>
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
                                                        Giá: {{ number_format($item->price, 0, ',') }} VNĐ VNĐ
                                                    </td>
                                                    <td>{{ $item->purchased_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </main>
        </div>
        <!-- Custom JavaScript -->
        <script>
            $(document).ready(function() {
                var dataTable1 = $('#user_data').DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'excel', 'print', 'colvis']
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                const rawButton = document.getElementById('raw-button');
                const rawTextarea = document.getElementById('raw-textarea');

                rawButton.addEventListener('click', function() {
                    // Toggle visibility of the textarea
                    if (rawTextarea.style.display === 'none' || rawTextarea.style.display === '') {
                        rawTextarea.style.display = 'block'; // Show textarea
                        rawButton.textContent = 'Thoát giản lược'; // Change button text
                    } else {
                        rawTextarea.style.display = 'none'; // Hide textarea
                        rawButton.textContent = 'Xem giản lược'; // Revert button text
                    }
                });
            });
            // Populate the textarea with the hidden input's value
            const content = document.getElementById('raw-content').value;
            document.getElementById('raw-textarea').value = content;
        </script>
        </body>

        </html>
    @endsection
