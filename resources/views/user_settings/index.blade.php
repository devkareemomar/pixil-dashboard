@extends('layout.app')

@section('title', __('User Setting'))
@section('description', __('User Setting'))

@section('content')
<div class="container-fluid" style="padding: 1%">

	<div class="card mb-80">
		<div class="card-body">
			<div class="row">
				<div style="padding: 1%;text-align: center">
					<h4>{{ __('User Setting') }}</h4>
				</div>
				<form enctype="multipart/form-data" class="col-10 offset-1" action="{{ route('userSettingUpdate') }}"
					method="POST">
					@csrf
					@method('PATCH')
					<div class="form-group">
						<label>{{ __('First Name') }} <span class="text-danger">*</span></label>
						<input required type="text" name="first_name" class="form-control"
							value="{{ old('first_name', $user->first_name) }}">
						@error('first_name')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('Last Name') }}</label>
						<input type="text" name="last_name" class="form-control"
							value="{{ old('last_name', $user->last_name) }}">
						@error('last_name')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('Email') }} <span class="text-danger">*</span></label>
						<input required type="email" name="email" class="form-control"
							value="{{ old('email', $user->email) }}">
						@error('email')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('Phone') }}</label>
						<input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
						@error('phone')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('Photo') }}</label>
						@if($user->photo != null)
						<img style="display: block" width="10%" src="{{asset('storage/'.$user->photo)}}">
						<br>
						@endif
						<input type="file" name="photo" class="form-control" value="{{ old('photo', $user->phone) }}">
						@error('photo')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('User Name') }} <span class="text-danger">*</span></label>
						<input disabled required type="text" name="username" class="form-control"
							value="{{ old('username', $user->username) }}">
						@error('username')
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