@extends('client.layouts.master')
@section('main')
    <div class="container-fluid vh-100">
        <center>
            <img src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" class="city__icon">
        </center>
        <h1 class="guide__title">Key bought</h1>
        <div class="card offset-lg-1 col-lg-10">
            <div class="mt-3 px-5 pt-3 table-responsive">
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
                                <td class="copy-cell" data-copy="{{ $item->key }}">{{ $item->key }}</td>
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
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable with all buttons explicitly
            const table = $("#user_data").DataTable({
                pageLength: 4,
                dom: "<'row'<'col-sm-12 col-md-10 mb-2'B><'col-sm-12 col-md-2'f>>" +
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
                columnDefs: [{
                        targets: [1, 2],
                        visible: true
                    },
                    {
                        targets: [2],
                        visible: false,
                        responsivePriority: 3
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

            // Raw button functionality
            const rawButton = document.getElementById('raw-button');
            const rawTextarea = document.getElementById('raw-textarea');
            const content = document.getElementById('raw-content').value;
            document.getElementById('raw-textarea').value = content;

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
