@extends('layout.app')

@section('title', __('Create Link'))
@section('description', __('Create a new Link'))

@section('content')
<div class="container-fluid pb-30 pt-30">

	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4>{{ __('Create Link') }}</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<form enctype="multipart/form-data" class="col-11 m-auto" action="{{ route('links.store') }}"
					method="POST">
					@csrf
					<div class="form-group">
						<label>{{ __('Code') }} <span class="text-danger">*</span></label>
						<input required type="text" name="code" class="form-control" value="{{ old('code') }}">
						@error('code')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('Platform') }}</label>
						<input type="text" name="platform" class="form-control" value="{{ old('platform') }}">
						@error('platform')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="row">
						<br>
						<div class="col-4 form-group">
							<div class="form-check">
								<input name="is_project" class="form-check-input" type="checkbox" id="is_project">
								<label class="form-check-label" for="flexCheckDefault">
									{{ __('Is Project') }}
								</label>
							</div>
							<br>
						</div>
						<div class="col-12 form-group" id="url_project">
							<label>{{ __('Url') }}</label>
							<input required type="text" name="url" class="form-control" value="{{ old('url') }}">
							@error('url')
							<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="col-12 form-group">
							<label>{{ __('User') }}</label>
							<select name="user_id" class="form-control">
								<option disabled>{{ __('Select your user') }}</option>
								@foreach ($users as $user)
								<option value="{{ $user->id }}">{{ $user->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<br>
					<button type="submit" class="btn btn-primary">{{ __('Create Link') }}</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.slim.js"
            integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
    <script>
        $('#is_project').click(function () {
            if ($('#is_project').is(':checked')) {
                $('#url_project').html(
                    '<label>{{ __('Project') }}</label>' +
                    '<select class="form-control" name="project_id" required>' +
                    '<option disabled>{{ __('Select your project') }}</option>'+
                    @foreach (\App\Models\Project::all() as $project)
                        '<option value="{{ $project->id }}">{{ $project->name }}</option>' +
                    @endforeach
                        '</select>')

            } else {
                $('#url_project').html(
                    '<label>{{ __('Url') }}</label>' +
                    '<input required type="text" name="url" class="form-control" value="{{ old('url') }}">' +
                    '@error('url')' +
                    '<p class="text-danger">{{ $message }}</p>' +
                    '@enderror')
            }
        });
    </script>
@endsection
