@extends('layout.app')

@section('title', __('Create social media'))
@section('description', __('Create a new social media'))

@section('content')
<div class="container-fluid pb-30 pt-30">
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4>{{ __('Create New social media') }}</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<form action="{{ route('social-media.store') }}" method="POST" class="col-11 m-auto"
					enctype="multipart/form-data">
					@csrf
					@include('social-media.partials._form')
					<button type="submit" class="btn btn-primary">{{ __('Create social media') }}</button>
				</form>
			</div>
		</div>
	</div>
	@endsection