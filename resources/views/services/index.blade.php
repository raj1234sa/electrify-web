@extends('layout.main')
@section('page-title', 'Services')
@section('page-header', 'Services')
@section('selected', 'service-list')
@section('action-button')
    {!! app\Http\draw_action_buttons($actions) !!}
@endsection
@section('main-body')
    <div class="table-responsive">
        <form id="filterForm">
            <div class="row">
                <div class="col-xs-1 lbl-search-box">
                    <label>Search: </label>
                </div>
                <div class="col-xs-2">
                    <input type="text" id="keyword">
                </div>
                <div class="col-xs-2">
                    <button type="button" class="btn btn-primary btn-sm" id="search">
                        <i class="ace-icon fa fa-search bigger-110"></i>Search
                    </button>
                    <button type="button" id="reset" class="btn btn-sm">Reset</button>
                </div>
            </div>
        </form>
        <table id="dataTable" class="ajax table table-striped table-hover" data-checkbox="true" data-load='get-services-list-ajax'>
            <thead>
                <tr>
                    <th class="text-center" width='1px' data-printhide="true"><input name='form-field-checkbox' type='checkbox' id ='table_select_all' class='ace table_checkbox'><span class='lbl'></span></th>
                    <th class="text-center">Sr</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th class="text-center">Status</th>
                    <th data-order="false" data-printhide="true">Action</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="grid-pager"></div>
@endsection
@section('js')
    <script>
        var tabletools = ['export', 'print'];
        var exportRoute = 'services-export';
    </script>
@endsection
