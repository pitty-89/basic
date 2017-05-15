$(function() {
    /**
     * Функция получения данных определяющих прогрессию
     * @param obj
     */
    function getAjaxData(obj) {
        var t = $(obj),
            form = t.closest('.form');
        $.ajax({
            method  : 'post',
            url     : form.data('ajax'),
            data    : { TEXT  : t.val() },
            success : function(data) {
                $('#container-result').html(data);
            }
        });
    }

    /**
     * Ввод чисел в поле input
     */
    $('.js-control').keyup(function() {
        setTimeout(getAjaxData(this), 2000);
    });

});