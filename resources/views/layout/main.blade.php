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
		window.location = "/?redirecturl="+backlink;
	</script>
@endif
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>@yield('page-title') :: Admin</title>
		<meta name="description" content="Common Buttons &amp; Icons" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}bootstrap.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_HOME}}font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}bootstrap-duallistbox.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}bootstrap-multiselect.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}select2.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}fonts.googleapis.com.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}ace-skins.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}ace-rtl.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}jquery.dataTables.min.css" />
		<script src="{{DIR_HTTP_JS}}ace-extra.min.js"></script>
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}chosen.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}daterangepicker.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}bootstrap-colorpicker.min.css" />
		<link rel="stylesheet" href="{{DIR_HTTP_CSS}}custom.css" />
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
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="{{URL::to('dashboard')}}" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Mahadev
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="{{DIR_HTTP_IMAGES}}avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									{{ ($adminobj) ? $adminobj['displayName'] : '' }}
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="{{URL::to('logout')}}">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					@php
						$dashboard = '';
					@endphp
					@if ($page_name == 'dashboard')
						@php
							$dashboard = 'active';
						@endphp
					@endif
					<li class="{{$dashboard}}">
						<a href="{{ URL::to('dashboard') }}">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text">Dashboard</span>
						</a>
					</li>
					@php
						$service = '';
						$servicelist = '';
					@endphp
					@if ($page_name == 'service-list' || $page_name == 'add-service')
						@php
							$service = 'active open';
							$servicelist = 'active';
						@endphp
					@endif
					
					<li class="{{$service}}">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text">Services</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<ul class="submenu">
							<li class="{{$servicelist}}">
								<a href="{{URL::to('service-list')}}">
									<i class="menu-icon fa fa-caret-right"></i>
									Services
								</a>
							</li>
						</ul>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							@php
								if(isset($breadcrumbs)) {
									echo app\Http\draw_breadcrumb($breadcrumbs);
								}
							@endphp
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							{{--  <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>  --}}

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Choose Skin</span>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1>
								@yield('page-header')
							</h1>
							<div class="text-right">
								@yield('action-button')
							</div>
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

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Mahadev</span>
							Electiritions &copy; 2020
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		<input id="csrf" class="hide" value="{{ csrf_token() }}">
		<script src="{{DIR_HTTP_JS}}jquery-2.1.4.min.js"></script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='{{DIR_HTTP_JS}}jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="{{DIR_HTTP_JS}}bootstrap.min.js"></script>
		<script src="{{DIR_HTTP_JS}}jquery.bootstrap-duallistbox.min.js"></script>
		<script src="{{DIR_HTTP_JS}}jquery.raty.min.js"></script>
		<script src="{{DIR_HTTP_JS}}bootstrap-multiselect.min.js"></script>
		<script src="{{DIR_HTTP_JS}}select2.min.js"></script>
		<script src="{{DIR_HTTP_JS}}jquery-typeahead.js"></script>
		<script src="{{DIR_HTTP_JS}}ace-elements.min.js"></script>
		<script src="{{DIR_HTTP_JS}}ace.min.js"></script>
		<script src="{{DIR_HTTP_JS}}dataTable.min.js"></script>
		<script src="{{DIR_HTTP_JS}}jquery-ui.custom.min.js"></script>
		<script src="{{DIR_HTTP_JS}}jquery.ui.touch-punch.min.js"></script>
		<script src="{{DIR_HTTP_JS}}chosen.jquery.min.js"></script>
		<script src="{{DIR_HTTP_JS}}spinbox.min.js"></script>
		<script src="{{DIR_HTTP_JS}}bootstrap-datepicker.min.js"></script>
		<script src="{{DIR_HTTP_JS}}bootstrap-timepicker.min.js"></script>
		<script src="{{DIR_HTTP_JS}}moment.min.js"></script>
		<script src="{{DIR_HTTP_JS}}daterangepicker.min.js"></script>
		<script src="{{DIR_HTTP_JS}}bootstrap-datetimepicker.min.js"></script>
		<script src="{{DIR_HTTP_JS}}bootstrap-colorpicker.min.js"></script>
		<script src="{{DIR_HTTP_JS}}jquery.knob.min.js"></script>
		<script src="{{DIR_HTTP_JS}}autosize.min.js"></script>
		<script src="{{DIR_HTTP_JS}}jquery.inputlimiter.min.js"></script>
		<script src="{{DIR_HTTP_JS}}jquery.maskedinput.min.js"></script>
		<script src="{{DIR_HTTP_JS}}bootstrap-tag.min.js"></script>
		<!-- inline scripts related to this page -->
		<script>
			var orderFalseIndex = [];
			$("thead tr th").each(function(index) {
				if ($(this).data('order') == false) {
					orderFalseIndex.push(index);
				}
			});
			var table = $('#dataTable.ajax').DataTable({
				"columnDefs": [{
					"orderable": false,
					"targets": orderFalseIndex
				}],
				"processing": true,
				"serverSide": true,
				"createdRow": function(row, data, index) {
					$("thead tr th").each(function(i) {
						if ($(this).hasClass('text-center')) {
							$(row).children(":nth-child(" + (i + 1) + ")").addClass('text-center');
						}
					});
				},
				"stateSave": true,
				"ajax": {
					"url": $('table').data('load'),
					"type": "POST",
					"data": {
						_token: $("#csrf").val()
					}
				}
			});
			function refresh() {
				table.ajax.reload( null, false );
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
			$(document).ready(function() {
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
							refresh();
						}
					});
				});
				$(document).delegate('a.ajax.delete', 'click', function(e) {
					e.preventDefault();
					var url = $(this).attr('href');
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
							refresh();
						}
					});
				});
			});
		</script>
		@yield("js")
	</body>
</html>
