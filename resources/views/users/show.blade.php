@extends('layout.app')

@section('title', __('User Details'))
@section('description', __('View details of a user'))

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h4 class="text-capitalize">{{ __('User Details') }}</h4>
		</div>
	</div>
	<div class="card mb-50">
		<div class="card-body">
			<p><strong>{{ __('Name') }}:</strong> {{ $user->name }}</p>
			<p><strong>{{ __('Email') }}:</strong> {{ $user->email }}</p>
			<p><strong>{{ __('Username') }}:</strong> {{ $user->username }}</p>
			<p><strong>{{ __('Phone') }}:</strong> {{ $user->phone }}</p>
			<p><strong>{{ __('Role') }}:</strong> {{ $user->role->name }}</p>
			<p><strong>{{ __('Status') }}:</strong> {{ $user->status }}</p>
		</div>
	</div>
</div>
@endsection