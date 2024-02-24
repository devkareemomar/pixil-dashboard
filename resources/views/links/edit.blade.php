@extends('layout.app')

@section('title', __('Edit Links'))
@section('description', __('Edit an existing Link'))

@section('content')

<div class="container-fluid pb-30 pt-30">
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4>{{ __('Edit Link') }}</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<form enctype="multipart/form-data" class="col-11 m-auto"
					action="{{ route('links.update', $result->id) }}" method="POST">
					@csrf
					@method('PATCH')
					<div class="form-group">
						<label>{{ __('Code') }} <span class="text-danger">*</span></label>
						<input required type="text" name="code" class="form-control" value="{{ $result->code }}">
						@error('code')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('Platform') }}</label>
						<input type="text" name="platform" class="form-control" value="{{ $result->platform }}">
						@error('platform')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="row">
						<br>
						@if($result->project_id == null)
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
							<input required type="text" name="url" class="form-control" value="{{ $result->url }}">
							@error('url')
							<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						@else
						<div class="col-4 form-group">
							<div class="form-check">
								<input name="is_project" class="form-check-input" type="checkbox" id="is_project"
									checked>
								<label class="form-check-label" for="flexCheckDefault">
									{{ __('Is Project') }}
								</label>
							</div>
							<br>
						</div>
						<div class="col-12 form-group" id="url_project">
							<label>{{ __('Project') }}</label>
							<select class="form-control" name="project_id" required>
								@foreach (\App\Models\Project::all() as $project)
								<option value="{{ $project->id }}" {{$result->project_id == $project->id ?
									'selected':""}}>{{ $project->name }}</option>
								@endforeach
							</select>
						</div>
						@endif
						<div class="form-group">
							<label>{{ __('User') }}</label>
							<select name="user_id" class="form-control">
								<option disabled>{{ __('Select your user') }}</option>
								@foreach ($users as $user)
								<option value="{{ $user->id }}" @selected($result->user_id == $user->id)
									{{ $user->name }}
								</option>
								@endforeach
							</select>
						</div>
					</div>
					<br>
					<button type="submit" class="btn btn-primary">{{ __('Update Link') }}</button>
				</form>
			</div>
		</div>
	</div>
	<script>
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
            });
        </script>
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
