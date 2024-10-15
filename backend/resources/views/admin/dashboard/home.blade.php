@extends('admin.master')
@section('main')

    <body>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Thống kê doanh thu hiện tại</h1>
                <p class="mb-4">Doanh thu được tính theo số lượng đơn của khách hàng trên hê thống (Không tính đơn đã huỷ
                    hoặc chưa hoàn thành)</p>
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Tổng doanh thu (Theo ngày)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($day['totalBillDay'], 0, ',', '.') }} VNĐ
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Tổng doanh thu (Theo tuần)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{ number_format($week['totalBillWeek'], 0, ',', '.') }} VNĐ </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Tổng doanh thu (Theo tháng)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($month['totalBillMonth'], 0, ',', '.') }}
                                            VNĐ
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Tổng doanh thu (Theo năm)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($year['totalBillYear'], 0, ',', '.') }} VNĐ
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Row -->
                <div class="row">

                    <div class="col-xl-8 col-lg-7">

                        <!-- Area Chart -->
                        {{-- <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                                <hr>
                            </div>
                        </div> --}}

                        <!-- Bar Chart -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Danh thu theo tháng</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-bar">
                                    <canvas id="myBarChart"></canvas>
                                </div>
                                <hr>

                            </div>
                        </div>

                    </div>

                    <!-- Donut Chart -->
                    {{-- <div class="col-xl-4 col-lg-5"> --}}
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Doanh thu theo tuần (%)</h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4">
                                    <canvas id="myPieChart"></canvas>
                                    <hr>
                                    <p>% Doanh thu được tính theo tuần hiện tại</p>
                                </div>
                                <hr>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- End of Main Content -->
        <script>
            var accountBillWeek = ({{ $week['percentAccountWeek'] }}) ;
            var percentRerollWeek = ({{ $week['percentRerollWeek'] }});
            var percentRechargeWeek = ({{ $week['percentRechargeWeek'] }});
            var test = @json($data);
            console.log(test);
        </script>
        <script>

        </script>
        <script src="{{ url('') . '/' }}vendor/chart.js/Chart.min.js"></script>
        <script src="{{ url('') . '/' }}js/admin/chart-area.js"></script>
        <script src="{{ url('') . '/' }}js/admin/chart-pie.js"></script>
        <script src="{{ url('') . '/' }}js/admin/chart-bar.js"></script>

    @endsection
