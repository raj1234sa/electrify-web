$(document).ready(()=> {
        var html = '<div class="table-tools">';
        tabletools.forEach(element => {
                if(element == 'print') {
                        var printHtml = '';
                        printHtml = '<button type="button" class="btn btn-white"><i class="fas fa-print"></i></button>';
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
});