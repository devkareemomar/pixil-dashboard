@extends('layout.app')

@section('title', __('Edit social media'))
@section('description', __('Edit social media'))

@section('content')
<div class="container-fluid pb-30 pt-30">
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4>{{ __('Edit social media') }}</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<form action="{{ route('social-media.update', $social_media->id) }}" method="POST"
					enctype="multipart/form-data">
					@csrf
					@method('PUT')
					@include('social-media.partials._form')
					<button type="submit" class="btn btn-primary">{{ __('Edit social media') }}</button>
				</form>
			</div>
		</div>
	</div>
	@endsection