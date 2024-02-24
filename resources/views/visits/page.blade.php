@extends('layout.app')
@section('title', __('Page Visits Details'))
@section('description', __('Page Visits Details'))
@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Page Visits Details') }}</h4>
		</div>
		<div class="card-body">

			<div class="table-responsive">
				<table class="table mb-20 table-borderless">
					<thead>
						<tr class="userDatatable-header">
							<th>{{ __('Page Name') }}</th>
							<th>{{ __('Type of Page') }}</th>

						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $page?->name ?? $page?->title ?? 'Unknown' }}</td>
							<td>{{ $visits->first()->type }}</td>
						</tr>
					</tbody>


				</table>
			</div>

			<div class="table-responsive">
				<table class="table mb-20 table-borderless">
					<thead>
						<tr class="userDatatable-header">
							<!-- <th>{{ __('Stay on Time') }}</th> -->
							<th>{{ __('Visitor Name') }}</th>
							<th>{{ __('Visit Date/Time') }}</th>
							<th>{{ __('IP') }}</th>
							<th>{{ __('Country') }}</th>
						</tr>
					</thead>
					<tbody>
						@forelse($visits as $visit)
						<tr>
							<!-- <td>{{ $visit->stay_on_time }}</td> -->
							<td>{{ $visit->username ?: __('Guest') }}</td>
							<td>{{ $visit->updated_at }}</td>
							<td>{{ $visit->last_visitor_ip }}</td>
							<td>
								{{$visit->country}}
								@if($visit->country_code)
								<img src="https://flagsapi.com/{{$visit->country_code}}/flat/64.png">
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
		@endsection