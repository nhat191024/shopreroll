<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Shop bán acc Honkai Star Rail và Genshin uy tín hàng đầu Việt Nam</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Mua bán tài khoản Honkai Star Rail, Shop acc Honkai Star Rail VIP, Reroll uy tín hàng đầu Việt Nam">
    <meta name="keywords"
        content="Shop acc Honkai Star Rail VIP,Mua bán tài khoản Honkai Star Rail,Mua Acc Genshin Giá Rẻ Nhất,reroll" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property='og:image' content='https://img.upanh.tv/2023/05/17/12312312312-01-01.png' />

    <link rel="canonical" href="https://shopreroll.com" />
    <link rel="icon" type="image/png" href="https://img.upanh.tv/2023/05/17/image84b9fdeeb04998fd.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        media="print" onload="this.media='all'">

    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css" media="print"
        onload="this.media='all'">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <!--custom css  -->
    <link rel="stylesheet" href="{{ url('') . '/' }}css/nav-foot.css">
    <link rel="stylesheet" href="{{ url('') . '/' }}css/home.css">
    <link rel="stylesheet" href="{{ url('') . '/' }}css/styles-2.css">
    <link rel="stylesheet" href="{{ url('') . '/' }}css/custom.css">

    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md nav-header mb-4">
        <div class="container">

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fas fa-bars" style="text-shadow: 2px 2px 2px #000000;color: #fff;"></i>
                </span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="/" class="nav-link">
                            <img src="https://img.upanh.tv/2023/05/17/12312312312-01-01.png" class="img-fluid"
                                style="margin-top: -8px;height: 165%">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/" class="nav-link menu-header shine-active">
                            <i class="ficon fa-lg fa fa-home"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown" id="topUp_balance">
                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="nav-link dropdown-toggle menu-header ">
                            Nạp tiền
                        </a>
                        <ul class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                            <li>
                                <a href="https://shopreroll.com/user/money/phone-card/send-card"
                                    class="dropdown-item "><i class="fas fa-money-check-alt mr-1"></i>
                                    Nạp bằng thẻ cào
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a href="https://shopreroll.com/user/money/auto-bank/info" class="dropdown-item">
                                    <i class="fas fa-university mr-1"></i>
                                    Nạp bằng bank, ví
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#recharge_service" class="nav-link menu-header">
                            Nạp Game
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"class="nav-link dropdown-toggle menu-header">
                            Lịch Sử Mua
                        </a>
                        <ul class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
                            <li>
                                <a href="{{ route('client.myAccGenshin') }}" class="dropdown-item ">
                                    <i class="fas fa-history mr-1"></i>
                                    Genshin
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a href="{{ route('client.MyKey.index') }}" class="dropdown-item ">
                                    <i class="fas fa-history mr-1"></i>
                                    Key / Reroll
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a href="#" class="dropdown-item">
                                    <i class="fas fa-history mr-1"></i>
                                    Acc chung
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>

            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto" style="position: absolute;right: 0px;">
                @if (Auth::check())
                    <li class="nav-item mr-3">
                        <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="dropdown-toggle btn btn-block btn-outline-warning font-weight-bold"
                            style="background: rgb(89 84 173 / 25%);">
                            <span class="text-light">[{{ Auth::user()->id }}] {{ Auth::user()->name }}:</span> {{ number_format(Auth::user()->balance) }}<sup></sup>
                        </span>
                        <ul class="dropdown-menu bg-white border-0 shadow" style="left: 0px; right: inherit;">
                            <li><span class="dropdown-item text-center text-sm text-muted">Level:
                                @if(Auth::user()->role == 0)
                                    Member
                                @elseif(Auth::user()->role == 1)
                                    Admin
                                @elseif(Auth::user()->role == 2)
                                    Collaborator
                                @endif
                            </span></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="{{ '' }}" class="dropdown-item text-dark"><i
                                        class="fas fa-history mr-1"></i> Biến động số dư
                                </a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="{{ '' }}" class="dropdown-item text-dark"><i
                                        class="fas fa-history mr-1"></i> Lịch sử khác
                                </a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="{{ '' }}" class="dropdown-item text-dark"><i
                                        class="fas fa-key mr-1"></i> Đổi mật khẩu
                                </a></li>
                            <li class="dropdown-divider"></li>
                            <li><a href="{{ route('logout') }}" class="dropdown-item text-dark"><i
                                        class="fa fa-dungeon mr-1"></i> Đăng xuất
                                </a></li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="#">
                            <button class="btn-pretty">Đăng ký</button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#">
                            <button class="btn-pretty">Đăng nhập</button>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
    @yield('main')
    </div>
    <footer class="mt-5 p-3">
        <div class="container-lg">
            <h2 class="guide__title mt-3">
                <a href="/">
                    <img src="https://img.upanh.tv/2023/05/17/12312312312-01-01.png"
                        style="margin-top: -8px;height: 45px">
                </a>
            </h2>
            <div class="row">
                <section class="col-12 col-lg-4">
                    <div class="h h4 link-active">
                        Về <a href='/' style="color: inherit;text-shadow:unset">shopreroll.com</a>
                    </div>
                    <p>
                        <span class="text-white font-system-ui">
                            <b>Chúng tôi làm việc một cách chuyên nghiệp, uy tín, nhanh chóng và luôn đặt quyền lợi của
                                bạn lên hàng đầu</b>
                        </span>
                        <br>
                    </p>
                    <p class="mt-3 small">
                        © shopreroll.com
                    </p>
                    <div class="h h5">
                        <i class="fa fa-language"></i> Ngôn ngữ
                    </div>
                </section>

                <section class="col-12 col-lg-4">
                    <div class="h h4 link-active">Chúng tôi</div>
                    <p>
                        <span class="text-white font-system-ui">
                            <b>Tất Cả Khách Hàng mua acc trên Shop Đều được Bảo hành 100%.
                                <br>
                                Khách hàng mua acc trên shop phải chủ động đổi |mật khẩu| và |mail| ngay trong vòng 24h
                                ngoài 24h shop ko chịu trách nhiệm.
                            </b>
                        </span>
                        <br>
                    </p>
                </section>
                <section class="col-12 col-lg-1">
                </section>
                <section class="col-12 col-lg-3">
                    <i class="fab fa-facebook-square fa-2x mr-2"></i>
                    <i class="fab fa-youtube fa-2x"></i>
                    <p class="mt-3 fw-bold"><i class="fa fa-phone mr-2"></i>Hotline: 0386496488</p>
                    <p class="fw-bold"><i class="fa fa-clock mr-2"></i>Work time: 12h - 24h</p>
                    <p class="fw-bold"><i class="fa fa-map-marked-alt mr-2"></i>Address: Ba Đình-HN</p>
                    <p class="m-0"></p>
                </section>
            </div>
        </div>
    </footer>

    </div>
    <ul class="nav-fixed">
        <li class="nav-fixed-zalo">
            <a target="_blank" href="https://zalo.me/0386496488"><img src="style/images/icon/zalo.png"></a>
        </li>
        <li class="nav-fixed-face">
            <a target="_blank" href="https://www.facebook.com/dat.ds.3">
                <i style="color: white"class="fab fa-facebook-f fa-lg"></i>
            </a>
        </li>
        <li class="nav-fixed-phone">
            <a href="tel:0386496488">
                <i style="color: white" class="fa fa-phone fa-lg"></i>
            </a>
        </li>
    </ul>

    <!-- DataTables JS -->
    <script
        src="https://cdn.datatables.net/v/bs4/jq-3.7.0/dt-2.2.2/b-3.2.2/b-colvis-3.2.2/r-3.0.4/sl-3.0.0/datatables.min.js"
        integrity="sha384-B8hhapBzyENLm121fc/+Itc1gDWTHRWHm+vNGfDZ3TF2jQEBhrdZRssP/CQ8Og+r" crossorigin="anonymous">
    </script>

    <!-- Additional DataTable Button Scripts -->
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>

    <!-- AdminLTE App -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js" defer></script>

    <!-- Custom JS -->
    @yield('scripts')
</body>

</html>
