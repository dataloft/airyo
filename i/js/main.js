
$(document).ready( function() {
    // Check All
    $('#checkAll').click(function () {
        $('input[name*=\'selected\']').prop("checked", true);
        $('#uncheckAll').removeClass("hidden");
        $(this).addClass("hidden");
     });
    // Uncheck All
    $('#uncheckAll').click(function () {

        $('input[name*=\'selected\']').prop('checked', false);

        $(this).addClass("hidden");
        $('#checkAll').removeClass("hidden");
        return;
    });
});