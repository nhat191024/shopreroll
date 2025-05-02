@extends('client.layouts.master')
@section('main')
<div class="container-fluid">
    <center>
        <img
            src="https://uploadstatic-sea.mihoyo.com/contentweb/20200319/2020031919242255224.png"
            class="city_icon" />
    </center>
    <h1 class="guide__title text-center">Acc Genshin Purchased</h1>
    <div>
        <div class="card custom-background">
            <div class="card-body">
                <div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên đăng nhập</th>
                                <th>Mật khẩu</th>
                                <th>Thông tin</th>
                                <th>Giá</th>
                                <th>Tiêu đề giới thiệu</th>
                                <th>Mua lúc</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>user01</td>
                                <td>*******</td>
                                <td>Thông tin 1</td>
                                <td>100,000 VNĐ</td>
                                <td>Gói 3</td>
                                <td>2024-12-03</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>user02</td>
                                <td>*******</td>
                                <td>Thông tin 2</td>
                                <td>200,000 VNĐ</td>
                                <td>Gói 5</td>
                                <td>2024-12-01</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>user03</td>
                                <td>*******</td>
                                <td>Thông tin 3</td>
                                <td>300,000 VNĐ</td>
                                <td>Gói 7</td>
                                <td>2024-12-02</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>user04</td>
                                <td>*******</td>
                                <td>Thông tin 4</td>
                                <td>400,000 VNĐ</td>
                                <td>Gói 9</td>
                                <td>2024-12-04</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>user05</td>
                                <td>*******</td>
                                <td>Thông tin 5</td>
                                <td>500,000 VNĐ</td>
                                <td>Gói 10</td>
                                <td>2024-12-05</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>user06</td>
                                <td>*******</td>
                                <td>Thông tin 6</td>
                                <td>600,000 VNĐ</td>
                                <td>Gói 12</td>
                                <td>2024-12-06</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tên đăng nhập</th>
                                <th>Mật khẩu</th>
                                <th>Thông tin</th>
                                <th>Giá</th>
                                <th>Tiêu đề giới thiệu</th>
                                <th>Mua lúc</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" />
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function() {
        const table = $("#example1").DataTable({
            pageLength: 5,

            dom: "<'row'<'col-sm-12 col-md-10 mb-2'B><'col-sm-12 col-md-2'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-10'i><'col-sm-12 col-md-2'p>>",
            buttons: ["copy", "csv", "excel", "print", "colvis"],
            order: [
                [6, "desc"]
            ],
            columnDefs: [{
                    targets: [1, 2, 4],
                    visible: true
                },
                {
                    targets: [2, 4],
                    visible: false,
                    responsivePriority: 3
                } // Ẩn cột 2 và 4 trên màn hình nhỏ
            ],
            lengthChange: false,
        });
    });
</script>
