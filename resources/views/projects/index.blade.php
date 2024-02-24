@extends('layout.app')

@section('title', __('Project List'))
@section('description', __('View all projects in the system'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Project List') }} ({{ $projects->links()->paginator->total()}})</h4>
			<div class="m-1 mt-3 d-flex">
				<a class="btn btn-secondary m-1 " style="display: inline-block;"
					href="{{route('projects.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a href="{{  route('projects.create') }}" style="display: inline-block" class="btn btn-primary m-1">{{
					__('Add Project') }}</a>

				@include('projects.partials._quick-add')
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'name' => 'text',
                                'slug' => 'text',
                                'sku' => 'text',
                                'start_date' => 'date',
                                'end_date' => 'date',
                                'category_id' => $categories,
                                'campaign_id' => $campaigns
                            ]" />

			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('projects.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
								<th>{{ __('Name') }}</th>
								<th>{{ __('Total Earned') }}</th>
								<th>{{ __('Total Wanted') }}</th>
								<th>{{ __('Status') }}</th>
								<th>{{ __('Start date') }}</th>
								<th>{{ __('End date') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($projects as $project)
							<tr>
								<td><input type="checkbox" name="selectedRows[]" value="{{ $project->id }}"
										class="row-checkbox"></td>
								<td>{{ $loop->iteration + $projects->links()->paginator->firstItem() - 1}}</td>
								<td>{{ $project?->currentLanguage()?->name ?? $project?->name }}</td>
								<td>{{ $project->total_earned }}</td>
								<td>{{ $project->total_wanted }}</td>
								<td>{{$project->status?->name }}</td>
								<td>{{date('d-m-Y', strtotime($project->start_date))}}</td>
								<td>{{ date('d-m-Y', strtotime($project->end_date))}}</td>
								<td>

									<x-action-buttons route="projects" :model="$project">
										<li class="list-inline-item">
											@include('projects.partials._links-action-button')
										</li>
										<li class="list-inline-item">
											<a data-bs-toggle="modal" data-bs-target="#exampleModal-{{$project->id}}"
												data-item="{{ $project->id }}"
												class="btn btn-danger btn-square p-0 rounded-circle"
												data-toggle="tooltip" data-placement="top"
												title="{{ __('Add Album') }}">
												<div class="d-flex align-items-center justify-content-center p-1">
													<i class="fa fa-image fa-sm m-0 p-0"></i>
												</div>
											</a>
										</li>
									</x-action-buttons>

								</td>
							</tr>

							@endforeach
							@if(count($projects)<=0) <tr>
								<td style="text-align: center" colspan="10"> {{__('No Data Yet')}}</td>
								</tr>
								@endif
						</tbody>
					</table>
				</div>
				<br>
				<div class="d-flex justify-content-center">
					{{ $projects->links()}}
				</div>

				<Br><Br>
			</form>
		</div>
	</div>
</div>
@foreach($projects as $project)
<div class="modal fade" id="exampleModal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> {{__('Add Album')}}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="{{route('project.album',$project->id)}}" enctype="multipart/form-data" method="post">
				@csrf
				<div class="modal-body">

					<label>{{ __('Album') }}</label>
					<select class="form-control" name="albums[]" multiple required>
						@foreach (\App\Models\Album::where('is_active',1)->get() as $album)
						<option value="{{ $album->id }}" @selected(in_array($album->
							id,$project->album?->pluck('id')->toArray()??[]))>{{ $album->title }}</option>
						@endforeach
					</select>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						{{__('Close')}}
					</button>
					<button type="submit" class="btn btn-primary">{{__('Save')}}</button>
				</div>
			</form>
		</div>
	</div>
</div>
@include('projects.partials._links-model')
@endforeach
</div>
@endsection
