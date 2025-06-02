@extends('admin.master')
@section('main')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Cài đặt hệ thống</h1>
        <div class="card mb-4 shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="site_name">Tên trang web</label>
                            <input id="" class="form-control" name="site_name" type="text" required value="{{ $data['site_name']?$data['site_name']->value:'' }}" maxlength="255" aria-describedby="" placeholder="Tên thương hiệu của bạn">
                            <small class="text-muted">Tên thương hiệu xuất hiện ở khắp nơi trên trang. Lưu ý kỹ khi đổi trường này.</small>
                        </div>
                        <div class="form-group">
                            <label for="commission_fee">Phí hoa hồng cộng tác viên (%)</label>
                            <input id="" class="form-control" name="commission_fee" type="number" value="{{ $data['commission_fee']?$data['commission_fee']->value:'0' }}" aria-describedby="" placeholder="VD: 10, 20, ...">
                            <small class="text-muted">VD: Nếu ghi là 10%. Thì hoa hồng trên mỗi đơn hàng do CTV đăng bán được sẽ được trừ 10% và CTV sẽ nhận được 90% còn lại.</small>
                        </div>
                        <div class="form-group">
                            <label for="site_logo">Ảnh (Logo)</label>
                            <div class="custom-file">
                                <input id="customFile" class="custom-file-input" name="site_logo" type="file" accept="image/*">
                                <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                            </div>
                            <small class="text-muted">Ảnh hiện tại: {{ $data['site_logo']?$data['site_logo']->value:'Không có ảnh' }}</small>
                        </div>
                        <div class="form-group">
                            <label for="site_favicon">Favicon</label>
                            <div class="custom-file">
                                <input id="customFile" class="custom-file-input" name="site_favicon" type="file" accept="image/*">
                                <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                            </div>
                            <small class="text-muted">Ảnh logo thu nhỏ của web được hiển thị trên tab trình duyệt.</small>
                            <br>
                            <small class="text-muted">Ảnh hiện tại: {{ $data['site_favicon']?$data['site_favicon']->value:'Không có ảnh' }}</small>
                            <br>
                            <small class="mb-2 text-gray-800">Lưu ý: Những thay đổi liên quan đến favicon có thể sẽ không hiệu lực ngay lập tức, yêu cầu xóa bộ nhớ đệm</small>
                        </div>
                        <a class="btn btn-primary mt-4" onclick="history.back()">Quay lại</a>
                        <button id="saveAdd" class="btn btn-success mt-4" type="submit">Lưu cài đặt</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
