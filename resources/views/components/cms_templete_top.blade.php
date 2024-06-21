<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-Survey</title>
    <link rel="icon" type="image/x-icon" href="{{url('/')}}/images/favicon.ico" />

	<!-- Global stylesheets -->
	{{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> --}}
	{{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  --}}
	<link href="{{url('/')}}/assetscms/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/assetscms/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/assetscms/css/minified/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/assetscms/css/minified/layout.min.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/assetscms/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="{{url('/')}}/assetscms/css/minified/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->


	<!-- Core JS files -->
	<script src="{{url('/')}}/assetscms/js/main/jquery.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/main/bootstrap.bundle.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/loaders/blockui.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/loaders/pace.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<!-- Chart -->
	<script src="{{url('/')}}/assetscms/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/visualization/c3/c3.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/visualization/d3/venn.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/visualization/echarts/echarts.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/visualization/loader.js"></script>
	
	<!-- End Chart -->
	<script src="{{url('/')}}/assetscms/js/plugins/forms/styling/uniform.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/forms/styling/switch.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/ui/moment/moment.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/pickers/daterangepicker.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/ui/sticky.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/forms/wizards/steps.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/forms/selects/select2.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/forms/validation/validate.min.js"></script>

	<script src="{{url('/')}}/assetscms/js/tabletoexcel.js"></script>

	<!-- Custom Template v2 -->
	<!-- CSS -->
	<link rel="stylesheet" href="{{url('/')}}/assetscms/css/alertifyjs/alertify.min.css" type="text/css" />
	<link rel="stylesheet" href="{{url('/')}}/assetscms/css/alertifyjs/themes/bootstrap.min.css" type="text/css" />

	<!-- JS  -->
	<script type="text/javascript" src="{{url('/')}}/assetscms/js/plugins/media/fancybox.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/assetscms/js/plugins/alertifyjs/alertify.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/assetscms/js/plugins/autoNumeric/autoNumeric.js" ></script>
	<!-- Custom Js -->

	<script src="{{url('/')}}/assetscms/js/app.js"></script>
	<!-- Custom Css & Js -->
	<script src="{{url('/')}}/assetscms/js/plugins/editors/summernote/summernote.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/extensions/cookie.js"></script>
	<script src="{{url('/')}}/assetscms/js/custom.js"></script>
	<link href="{{url('/')}}/assetscms/css/custom.css" rel="stylesheet" type="text/css">
	<!-- /Custom Template v2 -->
	<style>
		#diag {
			width: auto;
			height: 300px;
			overflow: auto;
		}
	</style>

</head>

<body>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="media">
			<div class="mr-1 ml-1 mt-1 mb-1">
				<img src="{{$data['logo'] ?? ''}}" width="30">
			</div>
			<div class="navbar-brand wmin-200" style="padding: 2px;">
				<div class="media-body">
					<a class="d-inline-block" href="/" style="font-size: 13px; color: white; padding: 0px;"><span style="font-weight:bold;">{{$data['company'] ?? ''}}</span></a>
				</div>
				<div class="font-size-xs opacity-50">
					{{$data['detail'] ?? ''}}
				</div>
			</div>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-user"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>
			<span class="badge bg-success-400 ml-md-auto mr-md-1">Online</span>
			<ul class="navbar-nav">
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="{{url('/')}}/assetscms/images/avatar.png" class="rounded-circle mr-2" height="34" alt="">
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{url('api/logoutcms')}}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->

	<!-- Secondary navbar -->
	<div class="navbar navbar-expand-md navbar-light navbar-sticky breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="{{url('/')}}/" class="breadcrumb-item"><i class="icon-home4 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">{{$data['page_active'] ?? ''??''}}</span>
			</div>

			<!-- <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a> -->
		</div>
		<div class="header-elements d-none">
			<div class="breadcrumb justify-content-center">
				<a href="#" class="breadcrumb-elements-item">
					<i class="icon-comment-discussion mr-2"></i>
					Support
				</a>
			</div>
		</div>
	</div><br>
	<!-- /secondary navbar -->
	<!-- Page content -->
	<div class="page-content pt-0">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-light sidebar-main sidebar-fixed sidebar-expand-md ">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				<span class="font-weight-semibold">Main sidebar</span>
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">
				<div class="card card-sidebar-mobile">

					<!-- Header -->
					<div class="card-header header-elements-inline">
						<h6 class="card-title">Navigation</h6>
						<div class="header-elements">
							<div class="list-icons">
								<a class="list-icons-item" data-action="collapse"></a>
							</div>
						</div>
					</div>

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="card-body">
							<div class="media">
								<div class="mr-3">
									<a href="#"><img src="{{url('/')}}/assetscms/images/avatar.png" width="38" height="38" class="rounded-circle" alt=""></a>
								</div>

								<div class="media-body">
									<div class="media-title font-weight-semibold">{{$data['company'] ?? ''??''}}</div>
									<div class="font-size-xs opacity-50">
										<i class="icon-user font-size-sm"></i> &nbsp; {{$data['name'] ?? ''??''}}
									</div>
								</div>

								<div class="ml-3 align-self-center">
									<a href="#" class="text-white"><i class="icon-cog3"></i></a>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="card-body p-0">
						<ul class="nav nav-sidebar" data-nav-type="accordion">
							<!-- Main -->
							<!-- /Main -->
							@foreach($data['authmenu'] as $menulevel1)
							@if($menulevel1['menuLevel']==1)
							@if(count($menulevel1['menuChild'])>0)
							<li class="nav-item nav-item-submenu">
								<a href="#" class="nav-link"><i class="{{$menulevel1['menuIcon']}}"></i> <span>{{$menulevel1['menuNama']}}</span></a>
								<ul class="nav nav-group-sub" data-submenu-title="Sub Menu levels">
									@foreach($menulevel1['menuChild'] as $menulevel2)
									@if($menulevel2['menuLevel']==2)
									@if(count($menulevel2['menuChild'])>0)
									<li class="nav-item nav-item-submenu">
										<a href="#" class="nav-link"> {{$menulevel2['menuNama']}}</a>
										<ul class="nav nav-group-sub">
											@foreach($menulevel2['menuChild'] as $menulevel3)
											@if($menulevel3['menuLevel']==3)
											@if(count($menulevel3['menuChild'])>0)
											<li class="nav-item nav-item-submenu">
												<a href="#" class="nav-link">{{$menulevel3['menuNama']}}</a>
												<ul class="nav nav-group-sub">
													@foreach($menulevel3['menuChild'] as $menulevel4)
													@if($menulevel4['menuLevel']==4)
													@if(count($menulevel4['menuChild'])>0)
													<li class="nav-item nav-item-submenu">
														<a href="#" class="nav-link">{{$menulevel4['menuNama']}}</a>
														<ul class="nav nav-group-sub">
														@foreach($menulevel4['menuChild'] as $menulevel5)
														<li class="nav-item"><a href="{{url('/')}}/{{$menulevel5['menuRoute']}}" class="nav-link">{{$menulevel5['menuNama']}}</a></li>
														@endforeach
														</ul>
													</li>
													@else
													<li class="nav-item"><a href="{{url('/')}}/{{$menulevel4['menuRoute']}}" class="nav-link">{{$menulevel4['menuNama']}}</a></li>
													@endif
													@endif
													@endforeach
												</ul>
											</li>
											@else
											<li class="nav-item"><a href="{{url('/')}}/{{$menulevel3['menuRoute']}}" class="nav-link"></i><span>{{$menulevel3['menuNama']}}</span></a></li>
											@endif
											@endif
											@endforeach

										</ul>
									</li>
									@else
									<li class="nav-item"><a href="{{url('/')}}/{{$menulevel2['menuRoute']}}" class="nav-link"></i><span>{{$menulevel2['menuNama']}}</span></a></li>
									@endif
									@endif
									@endforeach
								</ul>
							</li>
							@else
							<li class="nav-item">
								<a href="{{url('/')}}/{{$menulevel1['menuRoute']}}" class="nav-link"><i class="{{$menulevel1['menuIcon']}}"></i><span>{{$menulevel1['menuNama']}}</span></a>
							</li>
							@endif
							@endif
							@endforeach
						</ul>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /main sidebar -->

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">