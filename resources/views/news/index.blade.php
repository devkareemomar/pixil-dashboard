@extends('layout.app')

@section('title', __('News'))
@section('description', __('Manage News'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('News') }} ({{ $results->links()->paginator->total() }})</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('news.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a href="{{ route('news.create') }}" style="display: inline-block" class="btn btn-primary mb-3">{{
					__('Create News') }}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'title' => 'text',
                                'short_description' => 'text',
                            ]" />
			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('news.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
								<th>{{ __('Short Description') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($results as $key=>$result)

							<tr>
								<td><input type="checkbox" name="selectedRows[]" value="{{ $result->id }}"
										class="row-checkbox"></td>
								<td>{{ $loop->iteration + $results->links()->paginator->firstItem() - 1}}</td>
								<td>{{ $result?->currentLanguage()?->title ?? $result?->title}}</td>
								<td>{{$result?->currentLanguage()?->short_description ?? $result?->short_description }}
								</td>
								<td>
									<x-action-buttons route="news" :model="$result" />
								</td>
							</tr>
							@endforeach

							@if(count($results)<=0) <tr>
								<td style="text-align: center" colspan="4"> {{__('No Data Yet')}}</td>
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