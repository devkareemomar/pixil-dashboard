@extends('layout.app')

@section('title', __('Help List'))
@section('description', __('Manage Help List'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Help List') }} ({{ $results->links()->paginator->total() }})</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('helpList.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a href="{{ route('helps.create') }}" style="display: inline-block" class="btn btn-primary mb-3">{{
					__('Create Help List') }}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'name' => 'text',
                                'civil_id' => 'text',
                                'job' => 'text',
                                'salary' => 'text',
                                'address' => 'text',
                            ]" />
			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('helps.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
								<th>{{ __('Name') }}</th>
								<th>{{ __('Civil ID') }}</th>
								<th>{{ __('Job') }}</th>
								<th>{{ __('Salary') }}</th>
								<th>{{ __('Address') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($results as $key=>$result)
							<tr>
								<td><input type="checkbox" name="selectedRows[]" value="{{ $result->id }}"
										class="row-checkbox"></td>
								<td>{{ $loop->iteration + $results->links()->paginator->firstItem() - 1}}</td>
								<td>{{ $result->name }}</td>
								<td>{{ $result->civil_id }}</td>
								<td>{{ $result->job }}</td>
								<td>{{$result->salary}}</td>
								<td>{{$result->address}}</td>
								<td>
									<x-action-buttons route="helps" :model="$result" />
								</td>
							</tr>
							@empty
							<tr>
								<td style="text-align: center" colspan="7"> {{__('No Data Yet')}}</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<div class="d-flex justify-content-center">
			{{ $results->links()}}
		</div>
	</div>
</div>
@endsection