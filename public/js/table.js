$(document).ready(()=> {
        $(document).keyup(function(e) {
                if(e.which == 27 && window.printMode == true) {
                        drawTable([]);
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
                if(element == 'print') {
                        var printHtml = '';
                        printHtml = '<button type="button" class="btn btn-white print-btn"><i class="fas fa-print"></i></button>';
                        html += printHtml;
                }
                if(element == 'export') {
                        var exportHtml = '';
                        exportHtml = '<button type="button" data-export='+exportRoute+' class="btn btn-white btn-success export-btn"><i class="fa fa-file-excel"></i></button>';
                        html += exportHtml;
                }
        });
        html += '</div>';
        $("#filterForm").after(html);
        $(".export-btn").click(function() {
                var url = $(this).data('export');
                $.ajax({
                        url: url,
                        type: "GET",
                });
        });
        $(".print-btn").click(function() {
                window.printMode = true;
                drawTable([], 'print');
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