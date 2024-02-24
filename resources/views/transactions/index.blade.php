@extends('layout.app')

@section('title', __('Transactions'))
@section('description', __('Manage transactions'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize"> {{ __('Transaction List') }}
				({{ $transactions->links()->paginator->total() }})</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary" style="display: inline-block"
					href="{{route('transactions.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'category_id' => $categories,
                                'country_id' => $countries,
                                'project_id' => $projects,
                            ]" />
			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>
			<form action="{{route('transactions.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
					<table class="table mb-0 table-borderless">
						<thead>
							<tr class="userDatatable-header">
								<th><input type="checkbox" id="select-all-checkbox"></th>
								<th>#</th>
								<th>{{ __('Category') }}</th>
								<th>{{ __('Division') }}</th>
								<th>{{ __('Country') }}</th>
								<th>{{ __('Project') }}</th>
								<th>{{ __('Project Code') }}</th>
								<th>{{ __('Price') }}</th>
								<th>{{ __('Quantity') }}</th>
								<th>{{ __('Comment') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($transactions as $key => $transaction)
							<tr>
								<td><input type="checkbox" name="selectedRows[]" value="{{ $transaction->id }}"
										class="row-checkbox"></td>
								<td>{{ $loop->iteration + $transactions->links()->paginator->firstItem() - 1}}</td>
								<td>{{ $transaction->project?->category?->name }}</td>
								<td>{{ $transaction->project?->division?->name }}</td>
								<td>{{ $transaction->order?->country?->name }}</td>
								<td>{{ $transaction->project?->name }}</td>
								<td>{{ $transaction->project?->id }}</td>
								<td>{{ $transaction->price }}</td>
								<td>{{ $transaction->qty }}</td>
								<td>{{ $transaction->order?->description }}</td>
							</tr>
							@endforeach
							@if(count($transactions)<=0) <tr>
								<td style="text-align: center" colspan="11"> {{__('No Data Yet')}}</td>
								</tr>
								@endif
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<div class="d-flex justify-content-center">
			{{ $transactions->links() }}
		</div>
	</div>
</div>

@endsection