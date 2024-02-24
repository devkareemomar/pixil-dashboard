@extends('layout.app')

@section('title', __('User Setting'))
@section('description', __('User Setting'))

@section('content')
<div class="container-fluid" style="padding: 1%">

	<div class="card mb-80">
		<div class="card-body">
			<div class="row">
				<div style="padding: 1%;text-align: center">
					<h4>{{ __('User Change password') }}</h4>
				</div>
				<form enctype="multipart/form-data" class="col-10 offset-1"
					action="{{ route('userChangePasswordUpdate') }}" method="POST">
					@csrf

					<div class="form-group">
						<label>{{ __('Current password') }}</label>
						<input required type="password" name="current_password" class="form-control"
							value="{{ old('current_password') }}">
						@error('current_password')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('New password') }}</label>
						<input required type="password" name="new_password" class="form-control"
							value="{{ old('new_password') }}">
						@error('new_password')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('Confirm password') }}</label>
						<input required type="password" name="new_password_confirmation" class="form-control"
							value="{{ old('new_password_confirmation') }}">
						@error('new_password_confirmation')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>

					<button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection