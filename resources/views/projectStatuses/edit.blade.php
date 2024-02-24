@extends('layout.app')

@section('title', __('Edit Project Statuses'))
@section('description', __('Edit an existing Project Status'))

@section('content')
<div class="container-fluid pb-30 pt-30">
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4>{{ __('Edit Project Status') }}</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<form enctype="multipart/form-data" class="col-10 offset-1"
					action="{{ route('projectStatuses.update', $result->id) }}" method="POST" class="col-11 m-auto ">
					@csrf
					@method('PATCH')
					<div class="form-group">
						<label>{{ __('Name') }} <span class="text-danger">*</span></label>
						<input required type="text" name="name" class="form-control" value="{{$result->name}}">
						@error('name')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<div class="form-group">
						<label>{{ __('Description') }} <span class="text-danger">*</span></label>
						<input required type="text" name="description" class="form-control"
							value="{{$result->description}}">
						@error('description')
						<p class="text-danger">{{ $message }}</p>
						@enderror
					</div>
					<!-- <div class="form-group">
                            <label>{{ __('Color') }}</label>
                            <input type="color" name="color" class="form-control"
                                   value="{{ $result->color }}">
                            @error('color')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <br>
                        </div> -->
					<div class="row">
						<div class="col-4">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" role="switch" value="1" name="is_active"
									id="flexSwitchCheckChecked" {{$result->is_active ==1 ? "checked":''}}>
								<label class="form-check-label" for="flexSwitchCheckChecked">{{ __('Is Active')
									}}</label>
							</div>
						</div>
						<div class="col-4">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" value="1" role="switch"
									id="flexSwitchCheckChecked" name="is_new" {{$result->is_new ==1 ? "checked":''}}>
								<label class="form-check-label" for="flexSwitchCheckChecked">{{ __('Is New') }}</label>
							</div>
						</div>
						<div class="col-4">
							<div class="form-check form-switch">
								<input class="form-check-input" type="checkbox" value="1" role="switch"
									id="flexSwitchCheckChecked" name="is_completed" {{$result->is_completed ==1 ?
								"checked":''}}>
								<label class="form-check-label" for="flexSwitchCheckChecked">{{ __('Is Completed')
									}}</label>
							</div>
						</div>
					</div>
					<br>
					<button type="submit" class="btn btn-primary">{{ __('Update Project Status') }}</button>
				</form>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('.js-example-basic-multiple').select2();
		});
	</script>
	@endsection