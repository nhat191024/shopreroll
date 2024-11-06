$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

// Enable Selectpicker for searching heroes and weapons
$(document).ready(function () {
    $('.selectpicker').selectpicker();

    // Function to load heroes and weapons based on the selected game category
    function loadGameDetails(categoryId) {
        if (categoryId) {
            $.ajax({
                url: '/admin/game-account/get-game-details/' + categoryId,
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        var heroesOptions = '';
                        var weaponsOptions = '';

                        $.each(response.data.heroes, function (key, hero) {
                            heroesOptions += '<option value="' + hero.id + '">' + hero.name + '</option>';
                        });
                        $('#heroes').html(heroesOptions);
                        $('#heroes').selectpicker('refresh');

                        $.each(response.data.weapons, function (key, weapon) {
                            weaponsOptions += '<option value="' + weapon.id + '">' + weapon.name + '</option>';
                        });
                        $('#weapons1').html(weaponsOptions);
                        $('#weapons1').selectpicker('refresh');
                    }
                }
            });
        }
    }

    // Trigger the change event when the game category changes
    $('#game_category').change(function () {
        var categoryId = $(this).val();
        loadGameDetails(categoryId);
    });

    // Load game details on page load if there's a pre-selected game category
    var initialCategoryId = $('#game_category').val();
    if (initialCategoryId) {
        loadGameDetails(initialCategoryId);
    }
});
