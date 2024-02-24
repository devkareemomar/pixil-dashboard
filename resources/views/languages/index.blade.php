@extends('layout.app')

@section('title', __('Languages'))
@section('description', __('Manage languages'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Languages') }} ({{ $languages->links()->paginator->total() }})</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('languages.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a href="{{ route('languages.create') }}" style="display: inline-block" class="btn btn-primary mb-3">{{
					__('Create Language') }}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'name' => 'text',
                                'short_name' => 'text',
                                'is_default' => [ 1 => __('Yes'), 0 => __('No') ],
                            ]" />
			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('languages.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
								<th>{{ __('Short Name') }}</th>
								<th>{{ __('Flag') }}</th>
								<th>{{ __('Is Default') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($languages as $key=>$language)
							<tr>
								<th><input type="checkbox" name="selectedRows[]" value="{{ $language->id }}"
										class="row-checkbox"></th>
								<td>{{ $loop->iteration + $languages->links()->paginator->firstItem() - 1 }}</td>
								<td>{{ $language->name }}</td>
								<td>{{ $language->short_name }}</td>
								<td>
									<x-image src="{{$language->flag}}" />
								</td>
								<td>{{ $language->is_default ? __('Yes') : __('No') }}</td>
								<td>
									<x-action-buttons route="languages" :model="$language" :show="false">
										<li class="list-inline-item">
											<a href="{{ route('languages.translations', $language) }}"
												class="btn btn-info btn-square p-0 rounded-circle" data-toggle="tooltip"
												data-placement="top" title="{{ __('Translations') }}">
												<div class="d-flex align-items-center justify-content-center p-1">
													<i class="fa fa-language fa-sm m-0 p-0"></i>
												</div>
											</a>
										</li>
									</x-action-buttons>
								</td>
							</tr>
							@empty
							<tr>
								<td style="text-align: center" colspan="5"> {{__('No Data Yet')}}</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<div class="d-flex justify-content-center">
			{{ $languages->links() }}
		</div>
	</div>
</div>
@endsection