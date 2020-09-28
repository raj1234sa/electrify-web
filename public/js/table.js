$(document).ready(()=> {
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
        $("table").before(html);
        $(".export-btn").click(function() {
                var url = $(this).data('export');
                $.ajax({
                        url: url,
                        type: "GET",
                });
        });
        $(".print-btn").click(function() {
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
                $("thead tr th").each(function() {
                        if($(this).children('input[type=checkbox]').hasClass('table_checkbox') || $(this).html().includes('Action')) {
                                $(this).hide();
                        }
                });
                $("tbody tr td").each(function() {
                        if($(this).children('input[type=checkbox]').hasClass('table_checkbox') || $(this).html().includes('Action')) {
                                $(this).hide();
                        }
                });
        });
});