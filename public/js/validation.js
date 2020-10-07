$(document).ready(function () {
    $("div").each(function () {
        let element = $(this).find('input, select');
        if ($(this).data('validate-required') !== undefined) {
            $(this).append('<span class="text-danger error-star">*</span>');
        }
    });
    $('form').submit(function () {
        let formSubmit = true;
        $("div").each(function () {
            let element = $(this).find('input:not(.ignore), select:not(.ignore)');
            let EValue = $(element).val();
            let elemValid = true;
            if ($(this).data('validate-required') !== undefined) {
                let Error = $(this).data('validate-required');
                $("div#err_" + element.attr('id')).remove();
                if (EValue == '') {
                    $(this).append('<div id="err_' + element.attr('id') + '"><br><div class="text-danger">' + Error + '</div>');
                    formSubmit = false;
                    elemValid = false;
                }
            }
            if ($(this).data('validate-number') !== undefined && elemValid) {
                let Error = $(this).data('validate-number');
                $("div#err_" + element.attr('id')).remove();
                if (isNaN(EValue)) {
                    $(this).append('<div id="err_' + element.attr('id') + '"><br><div class="text-danger">' + Error + '</div>');
                    formSubmit = false;
                    elemValid = false;
                }
            }
        });
        return formSubmit;
    });
});
