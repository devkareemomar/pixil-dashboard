<!doctype html>
<html lang="en" dir="rtl">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{__('Change Database Connection')}}</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/css/plugin.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.0/css/line.css">
	{{--
		@if($setting?->application_logo_image)
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $setting?->application_logo_image) }}">
	@endif
	--}}
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

							<div class="card border-0 " style="margin-top: 120px">
								<div class="card-header">
									<div class="edit-profile__title">
										<h6>{{ trans('Change Database Connection') }} </h6>
									</div>
								</div>
								<div class="card-body">
									<form action="{{ url('dashboard/post/databaseConnection') }}" method="post">
										@csrf
										<div class="edit-profile__body">
											<div class="form-group mb-20">
												<label style="float: right" for="database_name"> {{ trans('Database
													Name') }}</label>
												<input class="form-control" type="text" name="database_name"
													id="inputField">
											</div>
											<div class="form-group mb-20">
												<label style="float: right" for="username"> {{ trans('Username') }} ({{
													trans('Database') }}
													)</label>
												<input class="form-control" type="text" name="username"
													id="inputField1">
											</div>
											<div class="form-group mb-20">
												<label style="float: right" for="password"> {{ trans('Password') }} ({{
													trans('Database') }}
													) </label>
												<input class="form-control" type="text" name="password"
													id="inputField2">
											</div>

											<span id="error" style="color: red;"></span>
											<br>
											<div
												class="admin__button-group button-group d-flex pt-1 justify-content-md-start justify-content-center">
												<button
													class="btn btn-primary btn-default w-100 btn-squared text-capitalize lh-normal px-50 signIn-createBtn ">
													{{ trans('Submit') }}
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
	<script>
		const inputField = document.getElementById("inputField");
		const error = document.getElementById("error");
		inputField.addEventListener("input", function() {
			const inputValue = inputField.value;
			console.log(inputValue);
			if (/\s/.test(inputValue)) {
				error.textContent = {
					{
						__('Spaces are not allowed')
					}
				};
				inputField.value = inputValue.replace(/\s/g, "");
			} else {
				error.textContent = "";
			}
		});
	</script>
	<script>
		const inputField1 = document.getElementById("inputField1");
		const error1 = document.getElementById("error");
		inputField1.addEventListener("input", function() {
			const inputValue = inputField1.value;
			console.log(inputValue);
			if (/\s/.test(inputValue)) {
				error1.textContent = {
					{
						__('Spaces are not allowed')
					}
				};
				inputField1.value = inputValue.replace(/\s/g, "");
			} else {
				error1.textContent = "";
			}
		});
	</script>
	<script>
		const inputField2 = document.getElementById("inputField2");
		const error2 = document.getElementById("error");
		inputField2.addEventListener("input", function() {
			const inputValue = inputField2.value;
			console.log(inputValue);
			if (/\s/.test(inputValue)) {
				error2.textContent = {
					{
						__('Spaces are not allowed')
					}
				};
				inputField2.value = inputValue.replace(/\s/g, "");
			} else {
				error2.textContent = "";
			}
		});
	</script>
	<script src="{{ asset('assets/js/plugins.min.js') }}"></script>
	<script src="{{ asset('assets/js/script.min.js') }}"></script>
</body>

</html>