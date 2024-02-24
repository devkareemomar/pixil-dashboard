@extends('layout.app')

@section('title', __('campaigns'))
@section('description', __('Manage campaigns'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('campaigns') }} ({{ $results->links()->paginator->total() }})</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('campaigns.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a href="{{ route('campaigns.create') }}" style="display: inline-block" class="btn btn-primary mb-3">{{
					__('Create Campaigns') }}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'title' => 'text',
                                'start_date' => 'date',
                                'end_date' => 'date',
                                'is_active' => [1 => __('Active'), 0 => __('Not Active')],
                                'is_home_slider' => [1 => __('Active'), 0 => __('Not Active')],
                            ]" />
			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('campaigns.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
								<th>{{ __('Title') }}</th>
								<th>{{ __('Start date') }}</th>
								<th>{{ __('End date') }}</th>
								<th>{{ __('Is active') }}</th>
								<th>{{ __('Is home slider') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($results as $key=>$result)
							<tr>
								<td><input type="checkbox" name="selectedRows[]" value="{{ $result->id }}"
										class="row-checkbox"></td>
								<td>
									{{ $loop->iteration + $results->links()->paginator->firstItem() - 1 }}
								</td>
								<td>{{ $result->title }}</td>
								<td>{{ date('Y-m-d', strtotime($result->start_date)) }}</td>
								<td>{{ date('Y-m-d', strtotime($result->end_date)) }}</td>
								<td>{{$result->is_active ==1 ? __('Active') : __('Not Active')}}</td>
								<td>{{$result->is_home_slider ==1 ? __('Active') : __('Not Active')}}</td>

								<td>
									<x-action-buttons :model="$result" route="campaigns" />
								</td>
							</tr>
							@endforeach
							@if(count($results)<=0) <tr>
								<td style="text-align: center" colspan="7"> {{__('No Data Yet')}}</td>
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
</div>

@endsection