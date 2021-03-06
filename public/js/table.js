$(document).ready(() => {
    $(document).keyup(function (e) {
        if (e.which == 27 && window.printMode == true) {
            drawTable(getSearchAction());
            $("#navbar").show();
            $("#breadcrumbs").show();
            $("#sidebar").show();
            $(".main-content").css('margin-left', "190px"); // 190
            $(".page-header").show();
            $("#filterForm").show();
            $(".table-tools").show();
            $(".dataTable_processing").show();
            $(".dataTables_length").show();
            $(".dataTables_paginate").show();
            $(".dataTables_info").show();
            window.printMode = false;
        }
    });
    $(document).delegate('.export-btn', 'click', function () {
        var url = $(this).data('export');
        var action = getSearchAction();
        var data = getSearchData(action);
        $.ajax({
            url: url,
            type: "POST",
            data: {data: data, _token: $("#csrf").val()},
            beforeSend: function () {
                startAjaxLoader();
            },
            success: function (data) {
                var $a = $("<a>");
                $a.attr("href", data.file);
                $("body").append($a);
                $a.attr("download", data.fileName);
                $a[0].click();
                $a.remove()
            },
            complete: function () {
                stopAjaxLoader();
            }
        });
    });
    $(document).delegate(".print-btn", 'click', function () {
        window.printMode = true;
        drawTable(getSearchAction(), 'print');
        $("#navbar").hide();
        $("#breadcrumbs").hide();
        $("#sidebar").hide();
        $(".main-content").css('margin-left', "0"); // 190
        $(".page-header").hide();
        $("#filterForm").hide();
        $(".table-tools").hide();
        $(".dataTable_processing").hide();
        $(".dataTables_length").hide();
        $(".dataTables_paginate").hide();
        $(".dataTables_info").hide();
    });
});
