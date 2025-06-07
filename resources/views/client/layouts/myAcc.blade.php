@extends('client.layouts.master')
@section('main')
    <style>
        #account-history th,
        #account-history td {
            text-align: center;
            vertical-align: middle;
        }
    </style>

    <section class="content">
        <div class="container-fluid v-100">
            <center>
                <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" />
            </center>
            <h1 class="guide__title">{{ $title }}</h1>
            <main>
                <div>
                    <!-- Default box -->
                    <div class="card col-lg-12">
                        <div class="table-responsive mt-3 pt-3">
                            <table id="account-history" class="table-striped table-bordered table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">ID</th>
                                        <th style="width: 15%;">Tên đăng nhập</th>
                                        <th style="width: 15%;">Mật khẩu</th>
                                        <th style="width: 25%;">Thông tin</th>
                                        <th style="width: 10%;">Giá</th>
                                        <th style="width: 15%;">Tiêu đề giới thiệu</th>
                                        <th style="width: 10%;">Mua lúc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($accountBills as $data)
                                        <tr>
                                            <td style="width: 5%;">#{{ $data->id }}</td>
                                            <td class="copy-cell" data-copy="{{ $data->GameAccount->username ?? 'N/A' }}" style="width: 15%;">
                                                {{ $data->GameAccount->username ?? 'N/A' }}
                                            </td>
                                            <td class="copy-cell" data-copy="{{ $data->GameAccount->password ?? 'N/A' }}" style="width: 15%;">
                                                {{ $data->GameAccount->password ?? 'N/A' }}
                                            </td>
                                            <td style="width: 25%;">
                                                @if($data->GameAccount)
                                                    @foreach ($data->GameAccount->AccountAttribute as $attr)
                                                        {{ $attr->GameAttribute->name }}: {{ $attr->value }}<br>
                                                    @endforeach
                                                    Note: {{ $data->GameAccount->note ?? 'N/A' }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td style="width: 10%;">{{ number_format($data->GameAccount->price_out ?? 0) }}đ</td>
                                            <td style="width: 15%;">{{ $data->GameAccount->title ?? 'N/A' }}</td>
                                            <td style="width: 10%;">{{ $data->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width: 5%;">ID</th>
                                        <th style="width: 15%;">Tên đăng nhập</th>
                                        <th style="width: 15%;">Mật khẩu</th>
                                        <th style="width: 25%;">Thông tin</th>
                                        <th style="width: 10%;">Giá</th>
                                        <th style="width: 15%;">Tiêu đề giới thiệu</th>
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
            const table = $("#account-history").DataTable({
                pageLength: 4,
                dom: "<'row'<'col-sm-6 col-md-10 mb-2'B><'col-sm-12 col-md-6'f>>" +
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
                    [6, "desc"]
                ],
                responsive: true,
                columnDefs: [{
                        targets: [3, 4, 5, 6],
                        visible: true,
                        responsivePriority: 10000 // Lower priority (will hide first on mobile)
                    },
                    {
                        targets: [0], // ID column
                        responsivePriority: 1 // Highest priority (will remain visible)
                    },
                    {
                        targets: [1], // Username column
                        responsivePriority: 2 // Second highest priority
                    },
                    {
                        targets: [2], // Password column
                        responsivePriority: 3 // Third highest priority
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

            // Copy to clipboard functionality
            function createTooltip(text) {
                const tooltip = document.createElement('div');
                tooltip.className = 'copy-tooltip';
                tooltip.textContent = text;
                document.body.appendChild(tooltip);
                return tooltip;
            }

            function showTooltip(tooltip, element, message) {
                const rect = element.getBoundingClientRect();
                tooltip.textContent = message;
                tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
                tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + 'px';
                tooltip.classList.add('show');

                setTimeout(() => {
                    tooltip.classList.remove('show');
                }, 1500);
            }

            // Initialize copy functionality for cells with class copy-cell
            const tooltip = createTooltip('');
            $(document).on('click', '.copy-cell', function() {
                const textToCopy = $(this).data('copy');
                const element = this;

                // Create a temporary textarea to copy from
                const tempTextarea = document.createElement('textarea');
                tempTextarea.value = textToCopy;
                document.body.appendChild(tempTextarea);
                tempTextarea.select();

                try {
                    const successful = document.execCommand('copy');
                    showTooltip(tooltip, element, successful ? 'Copied!' : 'Failed to copy!');
                } catch (err) {
                    showTooltip(tooltip, element, 'Failed to copy!');
                }

                document.body.removeChild(tempTextarea);
            });
        });
    </script>
@endsection
