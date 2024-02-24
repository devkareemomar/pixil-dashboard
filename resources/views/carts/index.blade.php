@extends('layout.app')

@section('title', __('Carts'))
@section('description', __('Manage carts'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Carts') }} ({{ $carts->links()->paginator->total() }})</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('carts.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'user_id' => $users,
                                'session_id' => 'text'
                            ]" />
			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('carts.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
				@csrf
				@method('DELETE')
				<div class="menu m-2" style="display: none;">
					<button type="submit" class="btn btn-danger" title="{{__('Delete Selected Rows')}}"
						data-toggle="tooltip" data-placement="top"
						onclick="return confirm('{{ __('Are you sure you want to delete this item?') }}')">
						<i class="fa fa-trash fa-sm m-0 p-2"></i>
					</button>
				</div>
				<div class="table-responsive">
					<table class="table mb-20 table-borderless">
						<thead>
							<tr class="userDatatable-header">
								<th><input type="checkbox" id="select-all-checkbox"></th>
								<th>#</th>
								<th>{{ __('User') }}</th>
								<th>{{ __('Session ID') }}</th>
								<th>{{ __('Total Amount') }}</th>
								<th>{{ __('Client Notes') }}</th>
								<th>{{ __('Admin Notes') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($carts as $cart)
							<tr>
								<td><input type="checkbox" name="selectedRows[]" value="{{ $cart->id }}"
										class="row-checkbox"></td>
								<td>{{ $loop->iteration + $carts->links()->paginator->firstItem() - 1}}</td>
								<td>{{ $cart->user?->name ?? __('Guest') }}</td>
								<td>{{ $cart->session_id }}</td>
								<td>{{ $cart->total_amount }}</td>
								<td>{{ $cart->client_notes }}</td>
								<td>{{ $cart->admin_notes }}</td>
								<td>
									<x-action-buttons :model="$cart" route="carts" />
								</td>
							</tr>
							@endforeach
							@if(count($carts)<=0) <tr>
								<td style="text-align: center" colspan="7"> {{__('No Data Yet')}}</td>
								</tr>
								@endif
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<div class="d-flex justify-content-center">
			{{ $carts->links()}}
		</div>
	</div>
</div>
@endsection