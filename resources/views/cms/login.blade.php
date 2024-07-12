<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-Survey Bakamla Kupang</title>
    <link rel="icon" type="image/x-icon" href="{{url('/')}}/images/favicon.ico" />

	<!-- Global stylesheets -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css"> -->
	<!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
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
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{url('/')}}/assetscms/js/plugins/forms/validation/validate.min.js"></script>
	<script src="{{url('/')}}/assetscms/js/plugins/forms/styling/uniform.min.js"></script>

	<script src="{{url('/')}}/assetscms/js/app.js"></script>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<!-- <script src="{{url('/')}}/assetscms/js/pages/login_validation.js"></script> -->
	<!-- /theme JS files -->

	<style type="text/css">
		.page-content {
/*		    background-image: url('{{url('/')}}/images/wall{{$wallidx ?? ''}}.jpg');*/
			-webkit-background-size: cover; /* For WebKit*/
		    -moz-background-size: cover;    /* Mozilla*/
		    -o-background-size: cover;      /* Opera*/
		    background-size: cover;
		}
		.navbar-inverse {
				background-color: #004b94;
				border-color: #004b94;
		}

		.material-icons {
		  font-family: 'Material Icons';
		  font-weight: normal;
		  font-style: normal;
		  font-size: 24px;  /* Preferred icon size */
		  display: inline-block;
		  line-height: 1;
		  text-transform: none;
		  letter-spacing: normal;
		  word-wrap: normal;
		  white-space: nowrap;
		  direction: ltr;

		  /* Support for all WebKit browsers. */
		  -webkit-font-smoothing: antialiased;
		  /* Support for Safari and Chrome. */
		  text-rendering: optimizeLegibility;

		  /* Support for Firefox. */
		  -moz-osx-font-smoothing: grayscale;

		  /* Support for IE. */
		  font-feature-settings: 'liga';
		}

		.grecaptcha-badge { 
		    visibility: hidden;
		}		

	</style>

</head>

<body>
<!-- navbar-inverse -->
	<!-- Main navbar -->


	<!-- Page content -->
	<div class="page-content" style="background-image: url('{{url('/')}}/images/wall10.jpg')">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">
				<script>
					function onSubmit(token) {
						document.getElementById("form").submit();
					}
				</script>

				<!-- Login card -->
				<form id="form" class="login-form form-validate" action="{{url('api/logincms')}}" method="POST">
					@csrf
					<div class="card mb-0" style="opacity: 0.8;background-color: #101010;border-radius:10px;">
						<div class="card-body">
							<div class="text-center mb-3">
								<a href="#" class="rounded-round p-3 mb-3 mt-1">
									<img src="{{url('/')}}/images/logo-bakamla.png" class="rounded-circle" height="120" alt="">
								</a><p>
								<h5 class="mb-0" style="color:white;">E-Survey Bakamla Kupang</h5>
								<span class="d-block text-muted">Masukan data login anda!</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" class="form-control" id="email" name="email" placeholder="E-mail" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<!-- <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button> -->

								<!-- <button id="button-no-recaptcha" type="submit" class="btn btn-primary btn-block d-none">Sign in <i class="icon-circle-right2 ml-2"></i></button> -->
								<button id="button-recaptcha" class="btn btn-primary btn-block g-recaptcha" data-sitekey="{{config('services.recaptcha.key')}}" data-callback='onSubmit' data-action='submit'>Login<i class="icon-circle-right2 ml-2"></i></button>

							</div>

							<div class="form-group text-center text-muted ">
								<span class="px-2 " style="color: red;"><i>{{$message}}</i></span>
							</div>
						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->


			<!-- Footer -->
			<!-- <div class="navbar navbar-expand-lg navbar-light">

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
					<a href="#">PT Optima Multi Sinergi </a> &copy; 2022 
					</span>
				</div>
			</div> -->
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
</html>
