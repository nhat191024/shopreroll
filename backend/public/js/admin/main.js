// Khởi tạo các biến toàn cục nếu không có sẵn từ server
window.selectedHeroes = window.selectedHeroes || [];
window.selectedWeapons = window.selectedWeapons || [];

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
                            // Kiểm tra nếu hero đã được chọn trước đó
                            var isSelected = window.selectedHeroes.includes(hero.id.toString()) ? 'selected' : '';
                            $('#hero').append('<option value="' + hero.id + '" ' + isSelected + '>' + hero.name + '</option>');
                        });
                    } else {
                        $('#hero').append('<option value="">Không có tướng</option>');
                    }
                    $('#hero').selectpicker('refresh');  // Làm mới selectpicker cho heroes

                    // Cập nhật danh sách weapons
                    $('#weapon1').empty();
                    if (response.data.weapons && response.data.weapons.length > 0) {
                        $.each(response.data.weapons, function (key, weapon) {
                            // Kiểm tra nếu weapon đã được chọn trước đó
                            var isSelected = window.selectedWeapons.includes(weapon.id.toString()) ? 'selected' : '';
                            $('#weapon1').append('<option value="' + weapon.id + '" ' + isSelected + '>' + weapon.name + '</option>');
                        });
                    } else {
                        $('#weapon1').append('<option value="">Không có vũ khí</option>');
                    }
                    $('#weapon1').selectpicker('refresh');  // Làm mới selectpicker cho weapons

                    // Gắn các giá trị đã chọn cho heroes và weapons (làm lại lần nữa sau khi DOM đã cập nhật)
                    $('#hero').val(window.selectedHeroes);
                    $('#hero').selectpicker('refresh');

                    $('#weapon1').val(window.selectedWeapons);
                    $('#weapon1').selectpicker('refresh');
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
    // Trigger sự kiện thay đổi danh mục game để lấy dữ liệu khi trang được tải
    $('#game_category').trigger('change');

    // Đổi tên file label khi người dùng chọn file
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
});
