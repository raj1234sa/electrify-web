@extends('layout.main')
@section('page-title', 'Import Services')
@section('page-header', 'Import Services')
@section('main-body')
    <div class="widget-box">
        <div class="widget-body">
            <div class="widget-main">
                <div id="fuelux-wizard-container">
                    <div>
                        <ul class="steps">
                            <li data-step="1" class="active">
                                <span class="step">1</span>
                                <span class="title">Download File</span>
                            </li>
                            <li data-step="2">
                                <span class="step">2</span>
                                <span class="title">Excel Help</span>
                            </li>
                            <li data-step="3">
                                <span class="step">3</span>
                                <span class="title">Upload File</span>
                            </li>
                        </ul>
                    </div>
                    <hr/>
                    <div class="step-content pos-rel">
                        <div class="step-pane active" data-step="1">
                            <div class="center">
                                {!! \App\Http\show_download_button(DIR_HTTP_CSV . 'import_service.csv') !!}
                            </div>
                        </div>

                        <div class="step-pane" data-step="2">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active">
                                    <a data-toggle="tab" href="#excel_details">
                                        EXCEL Details
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="excel_details" class="tab-pane fade in active">
                                    @include('services.import_help')
                                </div>
                            </div>
                        </div>
                        <div class="step-pane" data-step="3">
                            <div class="center">
                                {!! \App\Http\show_upload_button('/upload-service-file') !!}
                                <div class="center summary">
                                    <div class="text-center">
                                        <div id="rowsuccess"></div>
                                    </div>
                                    <div class="text-center ml6">
                                        <div id="rowskipped"></div>
                                    </div>
                                </div>
                                <div class="mt6 center-block summary">
                                    <div id="summary-div" class="table-responsive"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="wizard-actions">
                    <button class="btn btn-prev">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        Prev
                    </button>
                    <button class="btn btn-success btn-next" data-last="Finish">
                        Next
                        <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                    </button>
                </div>
            </div><!-- /.widget-main -->
        </div><!-- /.widget-body -->
    </div>
@endsection
@section('js')
    <script src="{{DIR_HTTP_JS.'import.js'}}"></script>
    <script>
        var $validation = false;
        $('#fuelux-wizard-container')
            .ace_wizard({
                //step: 2 //optional argument. wizard will jump to step "2" at first
                //buttons: '.wizard-actions:eq(0)'
            })
            .on('actionclicked.fu.wizard', function (e, info) {
                if (info.step == 2) {
                    $(".btn-next").addClass('disabled');
                }
            })
            //.on('changed.fu.wizard', function() {
            //})
            .on('finished.fu.wizard', function (e) {
                $.ajax({
                    url: '/service-importave',
                    type: 'GET',
                    beforeSend: function () {
                        startAjaxLoader();
                    },
                    success: function (response) {
                        stopAjaxLoader();
                        if(response == 'success') {
                            bootbox.dialog({
                                message: "Thank you! Your information was successfully saved!",
                                buttons: {
                                    "success" : {
                                        "label" : "OK",
                                        "className" : "btn-sm btn-primary"
                                    }
                                }
                            });
                        }
                    },
                    complete: function () {
                        stopAjaxLoader();
                    }
                });
            }).on('stepclick.fu.wizard', function (e) {
            //e.preventDefault();//this will prevent clicking and selecting steps
        });
    </script>
@endsection
