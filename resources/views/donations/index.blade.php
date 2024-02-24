@extends('layout.app')

@section('title', __('Donations'))
@section('description', __('Manage donations'))

@section('content')

<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Donations') }} ({{ $donations->links()->paginator->total() }})</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('donations.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'project_id' => $projects,
                                'user_id' => $users,
                                'phone' => 'text',
                                ]" />

			<div class="table-responsive">
				<table class="table mb-20 table-borderless">
					<thead>
						<tr class="userDatatable-header">
							<th>#</th>
							<th>{{ __('Project') }}</th>
							<th>{{ __('Amount') }}</th>
							<th>{{ __('User')}}</th>
							<th>{{ __('Donor') }}</th>
							<th>{{ __('Phone') }}</th>
							<th>{{ __('Reference') }}</th>
							<th>{{ __('Payment Method') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($donations as $donation)
						<tr>
							<td>{{ $loop->iteration + $donations->links()->paginator->firstItem() - 1}}</td>
							<td>{{ $donation->project?->name }}</td>
							<td>{{ $donation->price }}</td>
							<td>{{ $donation?->order?->user?->name ?? __('Guest')}}</td>
							<td>{{ $donation->order?->name }}</td>
							<td>{{ $donation->order?->phone }}</td>
							<td>{{ $donation->order?->payment?->metadata['id'] ?? '' }}</td>
							{{-- <td>{{ array_key_exists('focusTransaction', $donation->order?->payment?->metadata ?? []) ?
								$donation->order?->payment?->metadata['focusTransaction']['ReferenceId'] : '' }}</td> --}}
                           {{-- <td>{{ $donation->order?->payment?->payment_method ?? array_key_exists('focusTransaction',
								$donation->order?->payment?->metadata ?? []) ?
								$donation->order?->payment?->metadata['focusTransaction']['PaymentGateway'] ?? '' : '' }}</td> --}}
                            <td>{{ $donation?->order?->payment_type }}</td>
						</tr>
						@endforeach
						@if(count($donations)<=0) <tr>
							<td style="text-align: center" colspan="8"> {{__('No Data Yet')}}</td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
			<div class="d-flex justify-content-center">
				{{ $donations->links() }}
			</div>

		</div>
	</div>
</div>
@endsection
