@extends('layout.app')

@section('title', __('Links'))
@section('description', __('Manage Links'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Links') }} ({{ $results->links()->paginator->total() }})</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('links.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a href="{{ route('links.create') }}" style="display: inline-block" class="btn btn-primary mb-3">{{
					__('Create Link') }}</a>
			</div>
		</div>
		<x-filter :filter_attributes="[
                                'code' => 'text',
                                'project_id' => $projects,
                                'url' => 'text',
                ]" />
		<div class="form-check form-switch m-2">
			<input class="form-check-input" type="checkbox" role="switch" value="1" id="show" />
			<label class="form-check-label">{{ __('Advanced Options') }}</label>
		</div>

		<form action="{{route('links.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
							<th>{{ __('Code') }}</th>
							<th>{{ __('Project Name') }}</th>
							<th>{{ __('Url') }}</th>
							<th>{{ __('Platform') }}</th>
							<th>{{ __('Amount') }}</th>
							<th>{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($results as $key=>$result)
						<tr>

							<td><input type="checkbox" name="selectedRows[]" value="{{ $result->id }}"
									class="row-checkbox"></td>
							<th>{{ $loop->iteration + $results->links()->paginator->firstItem() - 1}}</th>
							<td>{{ $result->code }}</td>
							<td>{{ $result->project == null ? '' : $result->project->name }}</td>
							<td>{{ $result->url }}</td>
							<td>{{ $result->platform }}</td>
							<td>{{ $result->amount }}</td>
							<td>
								<x-action-buttons route="links" :model="$result" :show="    false" />
							</td>

						</tr>
						@endforeach
						@if(count($results)<=0) <tr>
							<td style="text-align: center" colspan="6"> {{__('No Data Yet')}}</td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</form>
	</div>
	<div class="d-flex justify-content-center">
		{{ $results->links() }}
	</div>
</div>
@endsection