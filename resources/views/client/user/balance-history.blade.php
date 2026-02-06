@extends('client.layouts.master')
@section('main')
    <style>
        #balance-history th,
        #balance-history td {
            text-align: center;
            vertical-align: middle;
        }
    </style>

    <section class="content">
        <div class="container-fluid h-100">
            <center>
                <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" />
            </center>
            <h1 class="guide__title">{{ $title }}</h1>
            <main>
                <div>
                    <!-- Default box -->
                    <div class="card col-lg-12">
                        <div class="table-responsive mt-3 pt-3">
                            <table id="balance-history" class="table-striped table-bordered table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">ID</th>
                                        <th style="width: 15%;">Tiền +/-</th>
                                        <th style="width: 15%;">Tiền trước sau</th>
                                        <th style="width: 20%;">Nội dung</th>
                                        <th style="width: 10%;">Loại</th>
                                        <th style="width: 10%;">Mua lúc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allBills as $data)
                                        @if (array_key_exists('id', $data))
                                            <tr>
                                                <td style="width: 5%;">{{ $data['id'] }}</td>
                                                <td class="copy-cell text-{{ $data['is_decrease'] ? 'danger' : 'success' }} font-weight-bold" data-copy="{{ $data['balance_change'] ?? 'N/A' }}" style="width: 15%;">
                                                    {{ $data['balance_change'] }} VND
                                                </td>
                                                <td class="copy-cell text-info font-weight-bold" data-copy="{{ isset($data['balance_before']) ? number_format($data['balance_before'], 0, ',', '.') : 'N/A' }} - {{ isset($data['balance_after']) ? number_format($data['balance_after'], 0, ',', '.') : 'N/A' }}" style="width: 15%;">
                                                    Trước: {{ isset($data['balance_before']) ? number_format($data['balance_before'], 0, ',', '.') : 'N/A' }} VND <br> Sau: {{ isset($data['balance_after']) ? number_format($data['balance_after'], 0, ',', '.') : 'N/A' }} VND
                                                </td>
                                                <td style="width: 25%;">
                                                    {!! $data['content'] ?? 'N/A' !!}
                                                </td>
                                                <td>{{ $data['type'] }}</td>
                                                </td>
                                                <td>{{ $data['created_at'] }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 10%;">ID</th>
                                        <th style="width: 15%;">Tiền +/-</th>
                                        <th style="width: 15%;">Tiền trước sau</th>
                                        <th style="width: 20%;">Nội dung</th>
                                        <th style="width: 10%;">Loại</th>
                                        <th style="width: 10%;">Mua lúc</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable with all buttons explicitly
            const table = $("#balance-history").DataTable({
                pageLength: 8,
                dom: "<'row'<'col-sm-6 col-md-6 mb-2'B><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>",
                buttons: [{
                        extend: 'copy',
                        text: 'Copy',
                        className: 'custom-dt-button'
                    },
                    {
                        extend: 'csv',
                        text: 'CSV',
                        className: 'custom-dt-button'
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        className: 'custom-dt-button'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        className: 'custom-dt-button'
                    },
                    {
                        extend: 'colvis',
                        text: 'Columns',
                        className: 'custom-dt-button'
                    }
                ],
                order: [
                    [5, "desc"]
                ],
                responsive: true,
                columnDefs: [{
                        targets: [3, 4, 5],
                        visible: true,
                        responsivePriority: 10000 // Lower priority (will hide first on mobile)
                    },
                    {
                        targets: [0], // ID column
                        responsivePriority: 1 // Highest priority (will remain visible)
                    },
                    {
                        targets: [1, 2], // Money columns
                        responsivePriority: 2 // Second highest priority
                    }
                ],
                lengthChange: true,
                language: {
                    paginate: {
                        previous: "Previous",
                        next: "Next",
                    }
                }
            });
        });
    </script>
@endsection
