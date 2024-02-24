@extends('layout.app')
@section('title', __('User Visits Details'))
@section('description', __('User Visits Details'))
@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('User Visits Details') }}</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table mb-20 table-borderless">
					<thead>
						<tr class="userDatatable-header">
							<th>{{ __('User Name') }}</th>
							<th>{{ __('Email') }}</th>
							<th>{{ __('User Created Date/Time') }}</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->created_at }}</td>
						</tr>
					</tbody>


				</table>
			</div>

			<div class="table-responsive">
				<table class="table mb-20 table-borderless">
					<thead>
						<tr class="userDatatable-header">
							<th>{{ __('Page Name') }}</th>
							<th>{{ __('Type Of Page') }}</th>
							<!-- <th>{{ __('Stay on Time') }}</th> -->
							<th>{{ __('Visit Date/Time') }}</th>
							<th>{{ __('IP') }}</th>
							<th>{{ __('Country') }}</th>
						</tr>
					</thead>
					<tbody>
						@forelse($activities as $activity)
						<tr>
							<td>{{ $activity->page_name }}</td>
							<td>{{ $activity->type }}</td>
							<!-- <td>{{ $activity->stay_on_time }}</td> -->
							<td>{{ $activity->updated_at }}</td>
							<td>{{ $activity->ip }}</td>
							<td>
								{{$activity->country}}
								@if($activity->country_code)
								<img src="https://flagsapi.com/{{$activity->country_code}}/flat/64.png">
								@endif
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="5">{{ __('No visit data available for this page.') }}</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection