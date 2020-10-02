@extends('layout.main')
@section('page-title', isset($postdata) ? 'Edit Customer' : 'Add Customer')
@section('page-header')
    @if ($postdata ?? '')
        Edit Customer
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            {{ $postdata['name'] }}
        </small>
    @else
        Add Customer
    @endif
@endsection
@section('main-body')
    <form class="form-horizontal" role="form" method="POST" action="/save-customer">
        @csrf
        <input type="text" class="hide" id="mode" name="mode" value="{{isset($postdata) ? 'edit':''}}"/>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="username">Username</label>
            <div class="col-sm-9">
                <input type="text" id="username" name="username" class="col-xs-10 col-sm-5"
                       value='{{isset($postdata)?$postdata['username']:''}}'/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="email_address">Email Address</label>
            <div class="col-sm-9">
                <input type="text" id="email_address" name="email_address" class="col-xs-10 col-sm-5"
                       value='{{isset($postdata)?$postdata['emailId']:''}}'/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="password">Password</label>
            <div class="col-sm-9">
                <input type="password" id="password" name="password" class="col-xs-10 col-sm-5"
                       value='{{isset($postdata)?$postdata['password']:''}}'/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label no-padding-right" for="phone_number">Phone Number</label>
            <div class="col-sm-9">
                <input type="text" id="phone_number" name="phone_number" class="col-xs-10 col-sm-5"
                       value='{{isset($postdata)?$postdata['phoneNumber']:''}}'/>
            </div>
        </div>
    </form>
@endsection
@section('form-action-button')
    @php
        echo app\Http\draw_form_buttons('save,save_back,back', array('backUrl'=>'/customer-list'));
    @endphp
@endsection
@section('js')

@endsection
