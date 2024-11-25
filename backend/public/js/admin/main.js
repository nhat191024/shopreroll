// Thay đổi file label khi người dùng chọn file
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

// Lấy danh sách heroes và weapons khi thay đổi danh mục game
$('#game_category').on('change', function () {
    var categoryId = $(this).val();
    if (categoryId) {
        $.ajax({
            url: '/admin/game-account/get-game-details/' + categoryId,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    // Cập nhật danh sách heroes
                    $('#hero').empty();
                    if (response.data.heroes && response.data.heroes.length > 0) {
                        $.each(response.data.heroes, function (key, hero) {
                            $('#hero').append('<option value="' + hero.id + '">' + hero.name + '</option>');
                        });
                    } else {
                        $('#hero').append('<option value="">Không có tướng</option>');
                    }
                    $('#hero').selectpicker('refresh');  // Làm mới selectpicker cho heroes

                    // Cập nhật danh sách weapons
                    $('#weapon1').empty();
                    if (response.data.weapons && response.data.weapons.length > 0) {
                        $.each(response.data.weapons, function (key, weapon) {
                            $('#weapon1').append('<option value="' + weapon.id + '">' + weapon.name + '</option>');
                        });
                    } else {
                        $('#weapon1').append('<option value="">Không có vũ khí</option>');
                    }
                    $('#weapon1').selectpicker('refresh');  // Làm mới selectpicker cho weapons
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Đã xảy ra lỗi khi tải thông tin chi tiết.');
            }
        });
    }
});

// Khởi tạo giá trị ban đầu khi trang được tải
$(document).ready(function () {
    $('#game_category').trigger('change');

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
});
