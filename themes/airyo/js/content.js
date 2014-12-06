$(document).ready(function(){

    $("#tpl").focus(function() {
        prev_val = $(this).val();
    }).change(function () {
            if (!confirm('Введенные данные будут потеряны. Поменять шаблон страницы?')) {
                $(this).val(prev_val);
                $(this).bind('focus');
                return false;
            }
            else
            {
                $("#change").val('1');
                $("#pages").submit();
            }
        })

});