$(document).ready(() => {
    $(document).keyup(function (e) {
        if (e.which == 27 && window.printMode == true) {
            var action = [];
            var empty = true;
            $("#filterForm button[type!=button], #filterForm select, #filterForm input").each(function () {
                if ($(this).val() == null || $(this).val() == "") {
                } else {
                    empty = false;
                    action.push([$(this).attr('id'), $(this).val()]);
                }
            });
            drawTable(action);
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
        }
    });
    var html = '<div class="table-tools">';
    tabletools.forEach(element => {
        if (element == 'print') {
            var printHtml = '';
            printHtml = '<button type="button" class="btn btn-white print-btn"><i class="fas fa-print"></i></button>';
            html += printHtml;
        }
        if (element == 'export') {
            var exportHtml = '';
            exportHtml = '<button type="button" data-export=' + exportRoute + ' class="btn btn-white btn-success export-btn"><i class="fa fa-file-excel"></i></button>';
            html += exportHtml;
        }
    });
    html += '</div>';
    $("#filterForm").after(html);
    $(".export-btn").click(function () {
        var url = $(this).data('export');
        var action = [];
        var empty = true;
        $("#filterForm button[type!=button], #filterForm select, #filterForm input").each(function () {
            if ($(this).val() == null || $(this).val() == "") {
            } else {
                empty = false;
                action.push([$(this).attr('id'), $(this).val()]);
            }
        });
        var data = "";
        if (action.length > 0) {
            action.forEach(function (item, index) {
                if (index > 0) {
                    data += "&";
                }
                data += item[0] + "=" + item[1];
            });
        }
        $.ajax({
            url: url,
            type: "POST",
            data: { data: data, _token:$("#csrf").val() },
            success: function(data) {
                var $a = $("<a>");
                $a.attr("href",data.file);
                $("body").append($a);
                $a.attr("download",data.fileName);
                $a[0].click();
                $a.remove()
            }
        });
    });
    $(".print-btn").click(function () {
        window.printMode = true;
        var action = [];
        var empty = true;
        $("#filterForm button[type!=button], #filterForm select, #filterForm input").each(function () {
            if ($(this).val() == null || $(this).val() == "") {
            } else {
                empty = false;
                action.push([$(this).attr('id'), $(this).val()]);
            }
        });
        drawTable(action, 'print');
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
