@extends('client.layouts.master')
@section('main')
    <section class="content">
        <div class="container-fluid vh-100">
            <center>
                <img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png"
                    class="city__icon" />
            </center>
            <h1 class="guide__title">Acc Genshin đã mua</h1>
            <main>
                <div>
                    <!-- Default box -->
                    <div class="card col-lg-12">
                        <div class="mt-3 pt-3 table-responsive">
                            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                    @if (count($accountBills) > 0)
                                        @foreach ($accountBills as $data)
                                            <tr>
                                                <td style="width: 5%;">{{ $data->id }}</td>
                                                <td class="copy-cell" style="width: 15%;"
                                                    data-copy="{{ $data->GameAccount ? $data->GameAccount->username : 'N/A' }}">
                                                    {{ $data->GameAccount ? $data->GameAccount->username : 'N/A' }}
                                                </td>
                                                <td class="copy-cell" style="width: 15%;"
                                                    data-copy="{{ $data->GameAccount ? $data->GameAccount->password : 'N/A' }}">
                                                    {{ $data->GameAccount ? $data->GameAccount->password : 'N/A' }}
                                                </td>
                                                <td style="width: 25%;">Server:
                                                    {{ $data->GameAccount ? $data->GameAccount->server : 'N/A' }}<br>
                                                    AR {{ $data->GameAccount ? $data->GameAccount->AR : 'N/A' }}<br>
                                                    Note:
                                                    {{ $data->GameAccount ? $data->GameAccount->note : 'N/A' }}</td>
                                                <td>{{ $data->price }}</td>
                                                <td>{{ $data->GameAccount ? $data->GameAccount->title : 'N/A' }}
                                                </td>
                                                <td>{{ $data->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">Không có tài khoản nào được mua
                                            </td>
                                        </tr>
                                    @endif
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
            const table = $("#dataTable").DataTable({
                pageLength: 4,
                dom: "<'row'<'col-sm-6 col-md-10 mb-2'B><'col-sm-12 col-md-2'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-10'i><'col-sm-12 col-md-2'p>>",
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
                    [0, "asc"]
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
