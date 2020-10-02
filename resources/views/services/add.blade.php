@extends('layout.main')
@section('page-title', isset($postdata) ? 'Edit Service' : 'Add Service')
@section('page-header')
    @if ($postdata ?? '')
        Edit Service
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            {{ $postdata['name'] }}
        </small>
    @else
        Add Service
    @endif
@endsection
@section('main-body')
    <form class="form-horizontal" role="form" method="POST" action="/save-service">
        @csrf
        <input type="text" class="hide" id="mode" name="mode" value="{{isset($postdata) ? 'edit':''}}"/>
        <input type="text" class="hide" id="service_id" name="service_id" value="{{$service_id}}"/>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="service_name">Service Name</label>
            <div class="col-sm-9">
                <input type="text" id="service_name" name="service_name" class="col-xs-10 col-sm-5"
                       value='{{isset($postdata)?$postdata['name']:''}}'/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="service_price">Service Amount</label>
            <div class="col-sm-9">
                <input type="text" id="service_price" name="service_price" data-type="number" class="only-number"
                       value='{{isset($postdata)?$postdata['price']:''}}'/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right no-padding-top">Status</label>
            <div class="col-sm-9">
                <input class="ace ace-switch ace-switch-6" type="checkbox" id="service_status" name="service_status"
                       value="1" {{(isset($postdata) && $postdata['status']) ? 'checked' : ''}} />
                <span class="lbl"></span>
            </div>
        </div>
    </form>
@endsection
@section('form-action-button')
    @php
        echo app\Http\draw_form_buttons('save,save_back,back', array('backUrl'=>'/service-list'));
    @endphp
@endsection
@section('js')

@endsection
