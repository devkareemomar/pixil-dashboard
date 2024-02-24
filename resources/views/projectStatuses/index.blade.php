@extends('layout.app')

@section('title', __('Project Statuses'))
@section('description', __('Manage Project Statuses'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Project Status') }} ({{ $results->links()->paginator->total() }}
				)</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('projectStatus.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a style="display: inline-block" href="{{ route('projectStatuses.create') }}"
					class="btn btn-primary mb-3">{{ __('Create Project Status') }}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'name' => 'text',
                                'description' => 'text',
                                'is_new' => [1 => __('Active'), 0 => __('Not Active')],
                                'is_active' => [1 => __('Active'), 0 => __('Not Active')],
                                'is_completed' => [1 => __('Active'), 0 => __('Not Active')],
                            ]" />

			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('projectStatuses.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
								<th>{{ __('Description') }}</th>
								<!-- <th>{{ __('Color') }}</th> -->
								<th>{{ __('Is New') }}</th>
								<th>{{ __('Is Active') }}</th>
								<th>{{ __('Is Completed') }}</th>
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
								<td>{{ strlen($result->description) > 50 ? substr($result->description, 0, 50) . '...' :
									$result->description }}</td>
								<!-- <td>
									<h6 class="form-control-color" style="background-color: {{ $result->color }} "></h6>
								</td> -->
								<td>{!! $result->is_new ==1 ? '<i class="fa fa-check text-success"></i>' : '<i
										class="fa fa-times text-danger"></i>' !!}</td>
								<td>{!! $result->is_active ==1 ? '<i class="fa fa-check text-success"></i>' : '<i
										class="fa fa-times text-danger"></i>' !!}</td>
								<td>{!! $result->is_completed ==1 ? '<i class="fa fa-check text-success"></i>' : '<i
										class="fa fa-times text-danger"></i>' !!}</td>

								<td>
									<x-action-buttons route="projectStatuses" :model="$result" :show="false" />
								</td>
							</tr>
							@empty
							<tr>
								<td style="text-align: center" colspan="8"> {{__('No Data Yet')}}</td>
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