var orderFalseIndex = [];
var columnDefs = [];

function drawTable(action=[], from='') {
        $("#filterForm select, #filterForm input, #filterForm button[type!=button]").each(function() {
                $.cookie("search_" + $(this).attr("id"), $(this).val());
        });
        var data = "";
        var defaultSorting = [[ 0, "asc" ]];
        if (action.length > 0) {
                action.forEach(function(item, index) {
                if (index > 0) {
                        data += "&";
                }
                data += item[0] + "=" + item[1];
                });
        }
        if(from == "print") {

        }
        $("#dataTable.ajax").DataTable().destroy();
        if($("table").data('checkbox') == true) {
                orderFalseIndex.push(0);
                defaultSorting = [[ 1, "asc" ]];
                columnDefs.push({
                        "width": '1px',
                        "targets": 0
                });
        }
        $("thead tr th").each(function(index) {
                if ($(this).data('order') == false) {
                        orderFalseIndex.push(index);
                }
        });
        columnDefs.push({
                "orderable": false,
                "targets": orderFalseIndex
        });
        var table = $('#dataTable.ajax').DataTable({
                "order": defaultSorting,
                "dom": 'tirlp<"clear">',
                "columnDefs": [
                        {
                                "orderable": false,
                                "targets": orderFalseIndex
                        }
                ],
                "pageLength": 
                "processing": true,
                "serverSide": true,
                "searching": false,
                "createdRow": function(row, data, index) {
                        $("thead tr th").each(function(i) {
                                if ($(this).hasClass('text-center')) {
                                        $(row).children(":nth-child(" + (i + 1) + ")").addClass('text-center');
                                }
                        });
                },
                "stateSave": false,
                "ajax": {
                        "url": $('table').data('load'),
                        "type": "POST",
                        "data": {
                                _token: $("#csrf").val(),
                                data: data,
                        }
                }
        });
        $(".dataTables_processing").empty();
        $(".dataTables_processing").append('<i class="ace-icon fa fa-spinner fa-spin white bigger-250"></i>');
}

setTimeout(function(){
        $(".alert.alert-dismissible").children('button').click();
}, 4000);
var index = 0;

function successMessage(message) {
        index = index+1;
        $("body").append("<div class='alert alert-success alert-dismissible' id='" + (index) + "'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Success!</strong> " + message + "</div>");
        setTimeout(()=> {
                $(".alert#"+index).children('button').click();
        }, 4000);
}

function failMessage(message) {
        index = index+1;
        $("body").append("<div class='alert alert-danger alert-dismissible' id='" + (index) + "'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Error!</strong> " + message + "</div>");
        setTimeout(()=> {
                $(".alert#"+index).children('button').click();
        }, 6000);
}
var action = [];
$(document).ready(function() {
        $("button").click(()=> {
                $(this).css("outline", 'none !important');
                $(this).css("decoration", 'none !important');
        });
        drawTable([]);
        var count = 0;
        $(".dataTables_processing").empty();
        $(".dataTables_processing").append('<i class="ace-icon fa fa-spinner fa-spin white bigger-250"></i>');
        $("#filterForm select, #filterForm input[type!=button]").each(function() {
                var tagName = $(this).prop("tagName").toLowerCase();
                switch (tagName) {
                        case "input":
                                if ($.cookie("search_" + $(this).attr("id")) != "") {
                                        $(this).val($.cookie("search_" + $(this).attr("id")));
                                        count++;
                                }
                                break;
                        case "select":
                                if ($.cookie("search_" + $(this).attr("id")) != "null") {
                                        $(this).val($.cookie("search_" + $(this).attr("id")));
                                        count++;
                                }
                                break;
                }
        });
        if (count > 0) {
                $("#filterForm input[type=button]#search-btn").trigger("click");
        }
        $("#filterForm").submit(function(e) {
                e.preventDefault();
                $("#filterForm button[type=button]#search").click();
        });
        $("#filterForm button#search").click(function() {
                action = [];
                var empty = true;
                $("#filterForm button[type!=button], #filterForm select, #filterForm input").each(function() {
                    if ($(this).val() == null || $(this).val() == "") {} else {
                        empty = false;
                        action.push([$(this).attr('id'), $(this).val()]);
                    }
                });
                drawTable(action);
        });
        $("#filterForm button[type=button]#reset").click(function() {
                $("#filterForm button[type!=button], #filterForm select, #filterForm input").val("");
                $("#filterForm button[type=button]#search").click();
        });
        $("input").each(function() {
                if($(this).data('type') == 'number') {
                        var value = 0;
                        var min = 1;
                        var max = 5000;
                        var step = 1;
                        if($(this).val() != '') {
                                value = $(this).val();
                        }
                        if($(this).attr('min') != undefined && $(this).attr('min') != '') {
                                min = $(this).attr('min');
                        }
                        if($(this).attr('max') != undefined && $(this).attr('max') != '') {
                                max = $(this).attr('max');
                        }
                        if($(this).attr('step') != undefined && $(this).attr('step') != '') {
                                step = $(this).attr('step');
                        }
                        $('#'+$(this).attr('id')).ace_spinner({
                                value:value,min:min,max:max,step:step, btn_up_class:'btn-info' , btn_down_class:'btn-info'
                        })
                        .closest('.ace-spinner')
                        .on('changed.fu.spinbox', function(){});
                }
        });
        $("input.only-number").keydown(function(e) {
                var key = e.charCode || e.keyCode || 0;
                return (
                        key == 8 || 
                        key == 9 ||
                        key == 13 ||
                        key == 46 ||
                        key == 110 ||
                        key == 190 ||
                        (key >= 35 && key <= 40) ||
                        (key >= 48 && key <= 57) ||
                        (key >= 96 && key <= 105));
        });
        $(".formsubmit").click(function() {
                var ids = $(this).attr('id');
                if(ids == 'formSubmit') {
                        $("form").prepend("<input class='hide' type='text' name='save' value='1'>");
                } else if(ids == 'formSubmitBack') {
                        $("form").prepend("<input class='hide' type='text' name='save_back' value='1'>");
                } else if(ids == 'backBtn') {
                        $("form").prepend("<input class='hide' type='text' name='back' value='1'>");
                }
                $("form").submit();
        });
        $("#formReset").click(function() {
                $("form").trigger('reset');
        });
        $(document).delegate('input.change_status.ajax', 'change', function() {
                var url = $(this).data('url');
                var id = $(this).parent().parent().attr('id').split(":")[1];
                var status = '0';
                if($(this).prop('checked')) {
                        status = '1';
                }
                $.ajax({
                        url: url,
                        type: 'POST',
                        data: { id: id, status: status, _token: $("#csrf").val() },
                        beforeSend: function() {
                                $(".alert.alert-dismissible").remove();
                        },
                        success: function(response) {
                                if(response == 'success') {
                                        successMessage("Status is changed successfully.");
                                } else {
                                        failMessage("Error while changing status.");
                                }
                        },
                        complete: function() {
                                drawTable(action);
                        }
                });
        });
        
        $(document).delegate('a.ajax.delete', ace.click_event, function(e) {
                e.preventDefault();
                var atag = $(this);
                bootbox.confirm("Are you sure to delete this record ?", function(result) {
                        if(result) {
                                var url = $(atag).attr('href');
                                $.ajax({
                                        url: url,
                                        type: "GET",
                                        success: function(response) {
                                                if(response=='success') {
                                                        successMessage('Data is deleted successfully.');
                                                } else {
                                                        failMessage('Error deleting data.');
                                                }
                                        },
                                        complete: function() {
                                                drawTable();
                                        }
                                });
                        }
                });
        });
        $("thead tr th > #table_select_all").change(function() {
                $("tbody tr td > input[class*=table_checkbox]").prop('checked', $(this).prop('checked'));
        });
});