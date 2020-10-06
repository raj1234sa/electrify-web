@php
    $adminobj = "";
@endphp
@if (Session::get('admin_login'))
    @php
        $adminobj = \App\Http\Controllers\DashboardController::getLoginAdminStatic();
    @endphp
@endif
@php
    $backlink = urlencode(DIR_HTTP_CURRENT_PAGE);
@endphp
@if($adminobj == "")
    <script>
        var backlink = "{{ $backlink }}";
        window.location = "/?redirecturl=" + backlink;
    </script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title>@yield('page-title') :: Admin</title>
    <meta name="description" content="Common Buttons &amp; Icons"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    @include('layout.css')
</head>

<body class="no-skin">
@if (Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> {{Session::get('success')}}
    </div>
@endif

@if (Session::get('fail'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        <strong>Error!</strong> {{Session::get('fail')}}
    </div>
@endif
@include('layout.header')

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.loadState('main-container')
        } catch (e) {
        }
    </script>

    @include('layout.sidebar')
    <div class="main-content">
        <div class="main-content-inner">
            @include('layout.breadcrumbs')
            <div class="page-content">
                <div class="page-header">
                    <h1>
                        @yield('page-header')
                    </h1>
                    @if (trim($__env->yieldContent('action-button')))
                        <div class="text-right action-buttons-div">
                            @yield('action-button')
                        </div>
                    @endif
                    @yield('form-action-button')
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                    @yield('main-body')
                    <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @include('layout.footer')
</div><!-- /.main-container -->

@include('layout.js')
</body>
</html>
