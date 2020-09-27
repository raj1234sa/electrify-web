@extends('layout.main')
@section('page-title', 'Services')
@section('page-header', 'Services')
@section('selected', 'service-list')
@section('action-button')
    {!! app\Http\draw_action_buttons($actions) !!}
@endsection
@section('main-body')
    <div class="table-responsive">
        <table id="dataTable" class="ajax table table-striped table-hover" data-load='get-services-list-ajax'>
            <thead>
                <tr>
                    <th class="text-center">Sr</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th class="text-center">Status</th>
                    <th data-order="false">Action</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="grid-pager"></div>
@endsection
@section('js')
    
@endsection
