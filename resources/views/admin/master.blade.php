<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/png" href="{{ asset($shared_config['site_favicon']?$shared_config['site_favicon']->value:'https://img.upanh.tv/2023/05/17/image84b9fdeeb04998fd.png') }}">
    <title>Shop game- Quản lý</title>

    <!-- Load jQuery FIRST (single version) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap 4 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- datatables css -->
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- chart.js css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css@1.1.0/dist/charts.min.css">

    <!-- font awesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- select2 css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- select2 bootstrap 5 theme css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!--  styles  -->
    <link href="{{ url('') . '/' }}css/sb-admin-2.css" rel="stylesheet">
    <link href="{{ url('') . '/' }}css/sb-admin-2-custom.css" rel="stylesheet">
    <link href="{{ url('') . '/' }}css/styles.css" rel="stylesheet">
</head>

<style>
    #dataTable th,
    #dataTable td {
        text-align: center;
        vertical-align: middle;
    }
</style>

@inject('game', 'App\Models\Game')
@inject('rerollCategory', 'App\Models\RerollCategory')
@php
    $games = $game::with('GameCategory')->get();
    $rerollCategories = $rerollCategory::all();
@endphp

<body id="page-top">
    <div id="wrapper">
        <ul id="menuAccordion" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('') . '/' }}admin">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('/image/avatar/logo.png') }}" width="100" style="max-height: 70px">
                </div>
                <div class="sidebar-brand-text mx-3">{{ $shared_config['site_name']?$shared_config['site_name']->value:'Default' }}</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Trang tổng quan</span></a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                <h6>Tài Khoản Game</h6>
            </div>
            @foreach ($games as $item)
                <li class="nav-item">
                    <a class="nav-link menu-link sidebar-item" data-toggle="collapse" href="#game-{{ str_replace(' ', '-', $item->name) }}" role="button" aria-expanded="false" aria-controls="game-{{ str_replace(' ', '-', $item->name) }}">
                        <i class="fa-solid fa-gamepad"></i>
                        <span data-key="t-layouts">{{ $item->name }}</span>
                    </a>
                    <div id="game-{{ str_replace(' ', '-', $item->name) }}" class="menu-dropdown collapse" data-parent="#menuAccordion">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.game_account.index', $item->id) }}">Danh sách chung</a>
                            </li>
                            @foreach ($item->GameCategory as $category)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.game_account.index', $item->id) }}?category_id={{ $category->id }}&status=1">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach


            @if(auth()->user()->role == 1)
                <hr class="sidebar-divider">
                <div class="sidebar-heading">
                    <h6>Game</h6>
                </div>
            @endif
            <div id="menuAccordion">
                @if(auth()->user()->role == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.game.index') }}">
                        <i class="fa-solid fa-users"></i>
                        <span>Game</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" data-toggle="collapse" href="#game-category" role="button" aria-expanded="false" aria-controls="account">
                        <i class="fa-solid fa-gamepad"></i>
                        <span data-key="t-layouts">Danh mục</span>
                    </a>
                    <div id="game-category" class="menu-dropdown collapse" data-parent="#menuAccordion">
                        <ul class="nav nav-sm flex-column">
                            @foreach ($games as $item)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.gameCategory.index', $item->id) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" data-toggle="collapse" href="#game-item-type" role="button" aria-expanded="false" aria-controls="account">
                        <i class="fa-solid fa-gamepad"></i>
                        <span data-key="t-layouts">Loại vật phẩm</span>
                    </a>
                    <div id="game-item-type" class="menu-dropdown collapse" data-parent="#menuAccordion">
                        <ul class="nav nav-sm flex-column">
                            @foreach ($games as $item)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.game_item_type.index', $item->id) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" data-toggle="collapse" href="#game-item" role="button" aria-expanded="false" aria-controls="account">
                        <i class="fa-solid fa-gamepad"></i>
                        <span data-key="t-layouts">Vật phẩm</span>
                    </a>
                    <div id="game-item" class="menu-dropdown collapse" data-parent="#menuAccordion">
                        <ul class="nav nav-sm flex-column">
                            @foreach ($games as $item)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.game_item.index', $item->id) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" data-toggle="collapse" href="#game-attribute" role="button" aria-expanded="false" aria-controls="account">
                        <i class="fa-solid fa-gamepad"></i>
                        <span data-key="t-layouts">Thuộc tính</span>
                    </a>
                    <div id="game-attribute" class="menu-dropdown collapse" data-parent="#menuAccordion">
                        <ul class="nav nav-sm flex-column">
                            @foreach ($games as $item)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.game_attribute.index', $item->id) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    <h6>Reroll</h6>
                </div>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.rerollCategory.index') }}" role="button"><i class="fa-solid fa-dice"></i>
                        <span data-key="t-layouts">Reroll</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" data-toggle="collapse" href="#rerollSubCate" role="button" aria-expanded="false" aria-controls="account">
                        <i class="fa-solid fa-dice"></i>
                        <span data-key="t-layouts">Reroll Sub Category</span>
                    </a>
                    <div id="rerollSubCate" class="menu-dropdown collapse" data-parent="#rerollSubCate">
                        <ul class="nav nav-sm flex-column">
                            @foreach ($rerollCategories as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.rerollSubCategory.index', $item->id) }}">{{ $item->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    <h6>Khác</h6>
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.gameRecharge.index') }}">
                        <i class="fa-solid fa-users"></i>
                        <span>Nạp Game</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.user.index') }}">
                        <i class="fa-solid fa-users"></i>
                        <span>Tài khoản người dùng</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" data-toggle="collapse" href="#history" role="button" aria-expanded="false" aria-controls="account">
                        <i class="fa-solid fa-gamepad"></i>
                        <span data-key="t-layouts">Lịch sử</span>
                    </a>
                    <div id="history" class="menu-dropdown collapse" data-parent="#menuAccordion">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.rechargeBill.index') }}">
                                    <span>Nạp game</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.rerollBill.index') }}">
                                    <span>Reroll</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.balanceRechargeBankBill.index') }}">
                                    <span>Nạp qua ngân hàng</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.balanceRechargeCardBill.index') }}">
                                    <span>Nạp qua thẻ điện thoại</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
            </div>

            @if(auth()->user()->role == 1)
            <!-- Divider -->
            <li class="nav-item {{ Request::is('settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-fw fa-gear"></i>
                    <span>Cài đặt</span></a>
            </li>
            @endif
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="d-sm-none d-md-inline text-center">
                <button id="sidebarToggle" class="rounded-circle border-0"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar static-top mb-4 bg-white shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" type="button">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a id="searchDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right animated--grow-in p-3 shadow" aria-labelledby="searchDropdown">
                                <form class="form-inline w-100 navbar-search mr-auto">
                                    <div class="input-group">
                                        <input class="form-control bg-light small border-0" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <a id="alertsDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter pending-bill-count">0</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right animated--grow-in shadow" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Hoá đơn đang chờ
                                </h6>
                                <div id="pending-bill-list" class="overflow-auto" style="max-height: 500px;"></div>
                                <div class="d-none billPendingTemplate">
                                    <a id="bill-link" class="dropdown-item d-flex align-items-center" href="">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div id="order_date" class="small text-gray-900">December 12, 2019</div>
                                            <span id="bill-description" class="font-weight-bold">Đơn hàng mới</span>
                                            <div id="bill-phone" class="small text-gray-900">0987654321</div>
                                        </div>
                                    </a>
                                </div>
                                <a class="dropdown-item small text-center text-gray-600" href="#">Xem toàn bộ
                                    đơn hàng</a>
                            </div>
                        </li> --}}

                        <!-- Nav Item - Messages -->
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <a id="messagesDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter message-count">0</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right animated--grow-in shadow" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Tin nhắn từ khách hàng
                                </h6>
                                <div id="message-list" class="overflow-auto" style="max-height: 500px;"></div>
                                <div class="d-none messageTemplate">
                                    <p id="message-id" class="d-none">0</p>
                                    <a id="message-link" class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="dropdown-list-image mr-3">
                                            <img class="rounded-circle" src="{{ asset('image/avatar/DefaultAvatar.png')}}" alt="...">
                                            <div class="status-indicator">
                                                <div id="message-index" style="font-size: 10px; transform: translate(1px, -5px)"></div>
                                            </div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div id="message-subject" class="text-truncate">Subject</div>
                                            <div id="message-info" class="small text-gray-900">Name · 1m</div>
                                        </div>
                                    </a>
                                </div>
                                <a class="dropdown-item small text-center text-gray-600" href="#">Xem thêm tin
                                    nhắn
                                </a>
                            </div>
                        </li> --}}

                        {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a id="userDropdown" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-lg-inline small mr-2 text-gray-600">#</span>
                                <img class="img-profile rounded-circle" src="{{ asset('image/avatar/DefaultAvatar.png')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right animated--grow-in shadow" aria-labelledby="userDropdown">
                                <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal" href="#">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>

                @yield('main')

            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright my-auto text-center">
                        <span>Copyright &copy;2024 Xây dựng và thiết kế | FPT Polytechnic Hải Phòng</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div id="logoutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 id="exampleModalLabel" class="modal-title">Đăng xuất?</h5>
                            <button class="close" data-dismiss="modal" type="button" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Xác nhận bạn muốn đăng xuất khỏi tài khoản này?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal" type="button">Hủy</button>
                            <a class="btn btn-primary" href="{{ route('logout') }}">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom scripts for all pages -->
    <script src="{{ url('') . '/' }}js/sb-admin-2.js"></script>

    <!-- datatables script (without jQuery) -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <!-- Select2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        const collapsedSidebarWidth = 104;
        const expanedSidebarWidth = 400;
        // Document ready function
        $(document).ready(function() {
            // Initialize Select2
            if (typeof $.fn.select2 === 'function') {
                $('.selectpicker').select2({
                    theme: 'bootstrap-5',
                    width: '100%',
                    placeholder: 'Select options',
                    allowClear: true,
                    closeOnSelect: false
                });
                console.log('Select2 initialized successfully');
            } else {
                console.error('Select2 plugin is not available');
            }

            // Initialize DataTables
            if (typeof $.fn.DataTable === 'function') {
                try {
                    $('#dataTable').DataTable({
                        responsive: true,
                        language: {
                            "lengthMenu": "Hiển thị _MENU_ mục trên trang",
                            "zeroRecords": "Không tìm thấy dữ liệu",
                            "info": "Hiển thị trang _PAGE_ / _PAGES_",
                            "infoEmpty": "Không có dữ liệu",
                            "infoFiltered": "(lọc từ _MAX_ tổng số)",
                            "search": "Tìm kiếm:",
                            "paginate": {
                                "first": "Đầu",
                                "last": "Cuối",
                                "next": "Sau",
                                "previous": "Trước"
                            }
                        }
                    });
                    console.log('DataTables initialized successfully');
                } catch (error) {
                    console.error('Error initializing DataTables:', error);
                }
            } else {
                console.error('DataTables plugin is not available');
            }
            // 104
            // 224
            $('.nav-item').on('click', (e) => {
                $('.sidebar').width(expanedSidebarWidth);
                $('.sidebar-divider').width('30%');
            });
            $('#content').on('click', (e) => {
                $('.sidebar').width(collapsedSidebarWidth);
                $('.sidebar-divider').width('70%');
            });
        });

        // the code below is for optimizing mobile experience, please keep it
        $(document).ready(() => {
            var accordionContainerSelector = '#menuAccordion';
            var $accordionContainer = $(accordionContainerSelector);

            if (!$accordionContainer.length) {
                var firstCollapseItem = $('.menu-dropdown.collapse[data-parent]').first();
                if (firstCollapseItem.length) {
                    var parentSelectorFromData = firstCollapseItem.data('parent');
                    if (parentSelectorFromData) {
                        $accordionContainer = $(parentSelectorFromData);
                        if ($accordionContainer.length) {} else {
                            return;
                        }
                    }
                } else {
                    return;
                }
            }
            $accordionContainer.on('click', 'a.sidebar-item[data-toggle="collapse"]', function(e) {
                var $clickedTrigger = $(this);
                var $targetPanel = $($clickedTrigger.attr('href'));

                if (!$targetPanel.length) {
                    return;
                }

                if ($targetPanel.hasClass('show')) {
                    e.preventDefault();
                    e.stopPropagation();
                    return;
                }

                e.preventDefault();
                e.stopPropagation();

                var $currentlyOpenPanels = $accordionContainer.find('.collapse.show').not($targetPanel);

                if ($currentlyOpenPanels.length > 0) {
                    $currentlyOpenPanels.collapse('hide');
                    // avoid janky or weird animation
                    $currentlyOpenPanels.one('hidden.bs.collapse', function() {
                        if (!$targetPanel.hasClass('show')) {
                            $targetPanel.collapse('show');
                        }
                    });
                } else {
                    if (!$targetPanel.hasClass('show')) {
                        $targetPanel.collapse('show');
                    }
                }
            });
        });
    </script>

    {{-- script section --}}
    @yield('scripts')

</body>

</html>
