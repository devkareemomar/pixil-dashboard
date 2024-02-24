@php
$setting  = \App\Models\Setting::first();
@endphp
<!doctype html>
<html lang="en" dir="rtl">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{__('Login')}}</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/plugin.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
	@if($setting?->application_logo_image)
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $setting?->application_logo_image) }}">
	@endif
</head>
<style>
	.field-icon {
		top: 66% !important;
	}
</style>

<body>
	<main class="main-content">
		<div class="admin" style="background-image:url({{ asset('assets/img/admin-bg-light.png') }});">
			<div class="container-fluid">
				<div class="row justify-content-center">
					<div class="col-xxl-3 col-xl-4 col-md-6 col-sm-8">
						<div class="edit-profile mt-50">
							<div class="edit-profile__logos">
								@if($setting?->dark_application_logo_image)
								<img style="width: 120px;" class="dark"
									src="{{ asset('storage/' . $setting?->dark_application_logo_image) }}" alt="">
								@endif
								@if($setting?->application_logo_image)
								<img style="width: 120px;" class="light" src="{{ asset('storage/' . $setting?->application_logo_image) }}"
									alt="">
								@endif
							</div>
							<div class="card border-0">
								<div class="card-header">
									<div class="edit-profile__title">
										<h6>{{ trans('Sign in') }} </h6>
									</div>
								</div>
								<div class="card-body">
									<form action="{{ route('login') }}" method="POST">
										@csrf
										<div class="edit-profile__body">
											<div class="form-group mb-20">
												<label style="float: right" for="username"> {{ trans('Username Or Email
													Address') }}</label>
												<input type="text" class="form-control" id="username" name="username"
													value="{{old('username')}}">
												@if($errors->has('username'))
												<p class="text-danger">{{$errors->first('username')}}</p>
												@endif
											</div>
											<div class="form-group mb-15">
												<label style="float: right" for="password-field">{{ trans('Password') }}
												</label>
												<div class="position-relative">
													<input id="password-field" type="password" class="form-control"
														name="password" value="">
													<span toggle="#password-field"
														class="uil uil-eye-slash text-lighten fs-15 field-icon toggle-password2"></span>
												</div>
												@if($errors->has('password'))
												<p class="text-danger">{{$errors->first('password')}}</p>
												@endif
											</div>
											<div style="float: right" class="admin-condition">
												<div class="checkbox-theme-default custom-checkbox ">
													<input class="checkbox" type="checkbox" id="check-1"
														name="remember">
													<label for="check-1">
														<span class="checkbox-text">{{ trans('Keep me logged in') }}
														</span>
													</label>
												</div>
												{{-- <a href="{{ route('password.request') }}">forget password?</a>--}}
											</div>
											<br><br><Br>
											<div
												class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
												<button
													class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn ">
													{{ trans('Sign in') }}
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<div id="overlayer">
		<div class="loader-overlay">
			<div class="dm-spin-dots spin-lg">
				<span class="spin-dot badge-dot dot-primary"></span>
				<span class="spin-dot badge-dot dot-primary"></span>
				<span class="spin-dot badge-dot dot-primary"></span>
				<span class="spin-dot badge-dot dot-primary"></span>
			</div>
		</div>
	</div>
	<div class="enable-dark-mode dark-trigger">
		<ul>
			<li>
				<a href="#">
					<i class="uil uil-moon"></i>
				</a>
			</li>
		</ul>
	</div>
	<script src="{{ asset('assets/js/plugins.min.js') }}"></script>
	<script src="{{ asset('assets/js/script.min.js') }}"></script>
</body>

</html>