@extends('layout.app')

@section('title', __('Alias Links Reports'))
@section('description', __('Manage Alias Links reports'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Alias Links Reports') }}({{ $reports->links()->paginator->total() }})
			</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('reports.alias-links.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'code' => 'text',
                                'platform' => 'text',
                                'projects' => $projects,
								'from_date' => 'date',
								'to_date' => 'date',
                            ]" />

			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="total_page">{{ __('Total Page') }}</label>
						<input type="text" disabled class="form-control" id="total_page"
							value="{{ $reports->sum('amount') }}">
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="to_data">{{ __('Total') }}</label>
						<input type="text" disabled class="form-control" id="to_data" name="to_data"
							value="{{ $total_amount }}">
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table mb-20 table-borderless">
					<thead>
						<tr class="userDatatable-header">
							<th>#</th>
							<th>{{ __('Code') }}</th>
							<th>{{ __('Platform') }}</th>
							<th>{{ __('Amount') }}</th>
							<th>{{ __('Project Id')}}</th>
							<th>{{__('Project')}}</th>
						</tr>
					</thead>
					<tbody>
						@forelse ($reports as $key=>$report)
						<tr>
							<td>{{ $loop->iteration + $reports->links()->paginator->firstItem() - 1}}</td>
							<td>{{ $report->code }}</td>
							<td>{{ $report->platform }}</td>
							<td>{{ $report->amount }}</td>
							<td>{{ $report->project_id }}</td>
							<td>{{ $report->project?->name }}</td>
						</tr>
						@empty
						<tr>
							<td style="text-align: center" colspan="10"> {{__('No Data Yet')}}</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			{{ $reports->links() }}
		</div>
	</div>
	@endsection