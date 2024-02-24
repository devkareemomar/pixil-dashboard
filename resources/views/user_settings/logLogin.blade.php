@extends('layout.app')

@section('title', __('User Log Login'))
@section('description', __('User Log Login'))

@section('content')
<div class="container-fluid" style="padding: 1%">

	<div class="card mb-80">
		<div class="card-body">
			<div class="row">
				<div style="padding: 1%;text-align: center">
					<h4>{{ __('User Log Login') }}</h4>
				</div>
				@foreach($logs as $log)
				<div class="col-12"
					style="border-radius:10px;padding: 1%;margin: 1% 0; {{$log->is_success == 0 ? 'border: red 4px solid;color:red !important' : 'border: green 4px solid; color:green'}}">
					<label>{{ __('IP Address') }}</label>
					<h4>{{$log->user_ip}}</h4>
					<label>{{ __('Browser Name') }}</label>
					<h4>{{$log->browser_name}}</h4>
					<label>{{ __('Login Time') }}</label>
					<h4>{{$log->created_at}}</h4>
				</div>
				@endforeach
			</div>
		</div>
	</div>
</div>
@endsection