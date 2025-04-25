@extends('client.layouts.master')
@section('main')
    <center>
        <img class="city__icon" src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png" />
    </center>
    <h1 class="guide__title">{{ $title }}</h1>
    <div class="card card-solid offset-lg-2 col-lg-8">
        <div class="card-body">
            @if (session()->has('error'))
                <marquee direction="right" behavior="alternate" class="alert alert-danger">
                    <i class="fa fa-quote-left"></i> {{ session('error') }}
                </marquee>
            @endif
            @if (session()->has('message'))
                <marquee direction="right" behavior="alternate" class="alert alert-info">
                    <i class="fa fa-quote-left"></i> {{ session('message') }}
                </marquee>
            @endif
            @if (session()->has('success'))
                <marquee direction="right" behavior="alternate" class="alert alert-success">
                    <i class="fa fa-quote-left"></i> {{ session('success') }}
                </marquee>
            @endif
            <div class="row">
                <div class="col-12 col-lg-12">
                    <h3 class="text-center">Nhập thẻ</h3>
                    <form method="post" action="{{ route('client.user.topup.card.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Nhà mạng
                            </label>
                            <select name="card_network" class="form-control" required="">
                                <option value="VIETTEL">Viettel - Khuyên dùng</option>
                                <option value="MOBIFONE">Mobifone</option>
                                <option value="VINAPHONE">Vinaphone</option>
                                <option value="VNMOBI">Vietnam Mobile - Hạn chế</option>
                                <option value="ZING">Zing</option>
                                <option value="GATE">Gate - Hạn chế</option>
                            </select>
                            @if ($errors->has('card_network'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('card_network') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mệnh giá
                            </label>
                            <select name="card_value" class="form-control" required="">
                                <optgroup label="Chọn cẩn thận. Sai sẽ bị phạt"></optgroup>
                                <option value="">Chọn mệnh giá</option>
                                <option value="10000">10,000 </option>
                                <option value="20000">20,000 </option>
                                <option value="30000">30,000 </option>
                                <option value="50000">50,000 </option>
                                <option value="100000">100,000 </option>
                                <option value="200000">200,000 </option>
                                <option value="300000">300,000 </option>
                                <option value="500000">500,000 </option>
                                <option value="1000000">1,000,000 </option>
                            </select>
                            @if ($errors->has('card_value'))
                                <span class="invalid-feedback d-block">
                                    <strong>{{ $errors->first('card_value') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 mt-2">
                                <label>Seri thẻ
                                </label>
                                <div class="input-group row">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                                    </div>
                                    <input name="card_seri" type="text" class="form-control concave " value=""
                                        placeholder="Điền seri của thẻ cào">
                                </div>
                                @if ($errors->has('card_seri'))
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $errors->first('card_seri') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 col-lg-6 mt-2">
                                <label>Mã thẻ
                                </label>
                                <div class="input-group row">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pen-fancy"></i></span>
                                    </div>
                                    <input name="card_pin" type="text" class="form-control concave " value=""
                                        placeholder="Điền mã của thẻ cào">
                                </div>
                                @if ($errors->has('card_pin'))
                                    <span class="invalid-feedback d-block">
                                        <strong>{{ $errors->first('card_pin') }}</strong>
                                    </span>
                                @endif


                        </div>
                        <div class="col-12">
                            <div class="form-group mt-4 text-center">
                                <button type="submit" name="submit" value="submit" class="btn btn-pretty">Yêu cầu
                                    nạp</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <h3 class="text-center">Hướng dẫn</h3>
                    <p class="bg-dark text-white p-2 rounded">
                        <span style="font-weight: bolder; font-size: 1.2em;">Lưu ý!!!</span>&nbsp;Vui lòng chọn đúng mệnh giá, sai là mất
                        thẻ.<br>Ưu tiên nạp Thẻ&nbsp;&nbsp;
                        <span style="background-color: #E03E2D; color: #ECF0F1;">VINAPHONE +&nbsp; ZING&nbsp;</span>
                        &nbsp;ít lỗi và xử lí nhanh<br>
                        <span style="color: #ff8f83;">Hiện tại quý khách nạp vào 100.000 tiền thẻ cào sẽ được 80.000 tiền shop do quy đổi từ thẻ cào ra tiền
                            mặt tốn phí ạ!</span><br>                    </p>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive mt-3 pt-3">
                        <table id="balance-history" class="table-striped table-bordered table" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 15%;">Trạng thái</th>
                                    <th style="width: 15%;">Nhà mạng</th>
                                    <th style="width: 20%;">Mệnh giá/Tiền nhận</th>
                                    <th style="width: 10%;">Seri/Mã</th>
                                    <th style="width: 10%;">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($balanceRechargeCardBills as $data)
                                    {{-- @if (array_key_exists('id', $data)) --}}
                                        <tr>
                                            <td style="width: 5%;">{{ $data->id }}</td>
                                            <td style="width: 15%;">
                                                <div class="color-palette-set text-center">
                                                    <div class="bg-info color-palette p-1">
                                                        <span>{{ $data->note }}</span>
                                                    </div>
                                                    <div class="bg-info disabled color-palette p-1">
                                                        <span>{{ $data->status }}<sup></sup></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="copy-cell text-success font-weight-bold"
                                                data-copy="{{ $data->mobile_carrier ?? 'N/A' }}"
                                                style="width: 15%;">
                                                {{ $data->mobile_carrier ?? 'N/A' }}
                                            </td>
                                            <td style="width: 25%;">
                                                Mệnh giá chọn: <b>{{ number_format($data->amount_fake) ?? 'N/A', 0, ',', '.' }} VND</b> <br> Mệnh giá thực: <b>{{ number_format($data->amount_real) ?? 'N/A', 0, ',', '.' }} VND</b></b> <br> Tiền nhận: <b>{{ number_format($data->balance_added) ?? 'N/A', 0, ',', '.' }} VND</b>
                                            </td>
                                            <td>Serial: <b>{{ $data->serial ?? 'N/A', 0, ',', '.' }}</b> <br> Mã thẻ: <b>{{ $data->amount_real?? 'N/A', 0, ',', '.' }}</b></td>
                                            </td>
                                            <td>{{ $data->created_at }}</td>
                                        </tr>
                                    {{-- @endif --}}
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="width: 10%;">ID</th>
                                    <th style="width: 15%;">Trạng thái</th>
                                    <th style="width: 15%;">Nhà mạng</th>
                                    <th style="width: 20%;">Mệnh giá/Tiền nhận</th>
                                    <th style="width: 10%;">Seri/Mã</th>
                                    <th style="width: 10%;">Time</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
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

