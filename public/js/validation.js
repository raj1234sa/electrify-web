$(document).ready(function () {
    $('form').submit(function () {
        var formSubmit = true;
        $("div").each(function () {
            var element = $(this).find('input, select');
            var EValue = $(element).val();
            var elemValid = true;
            if ($(this).data('validate-required') !== undefined) {
                var Error = $(this).data('validate-required');
                $("div#err_"+element.attr('id')).remove();
                if (EValue == '') {
                    $(this).append('<div id="err_'+element.attr('id')+'"><br><br><div class="text-danger">' + Error + '</div>');
                    formSubmit = false;
                    elemValid = false;
                }
            }
            if ($(this).data('validate-number') !== undefined && elemValid) {
                var Error = $(this).data('validate-number');
                $("div#err_"+element.attr('id')).remove();
                if (isNaN(EValue)) {
                    $(this).append('<div id="err_'+element.attr('id')+'"><br><br><div class="text-danger">' + Error + '</div>');
                    formSubmit = false;
                    elemValid = false;
                }
            }
        });
        return formSubmit;
    });
});
