@extends('layout.app')

@section('title', __('News Categories'))
@section('description', __('Manage News categories'))

@section('content')
<div class="container-fluid">
	<br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('News Categories') }} ({{ $categories->links()->paginator->total() }})
			</h4>


			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('newsCategories.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a href="{{ route('news_categories.create') }}" style="display: inline-block"
					class="btn btn-primary mb-3">{{ __('Create News Category') }}</a>
			</div>
		</div>
		<div class="card-body">

			<x-filter :filter_attributes="[
                                'name' => 'text',
                                'slug' => 'text',
                            ]" />
			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('news_categories.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
								<th>{{ __('Slug') }}</th>
								<th>{{ __('Featured') }}</th>
								<th>{{ __('Image') }}</th>
								<!-- <th>{{ __('Icon') }}</th>
                            <th>{{ __('Actions') }}</th> -->
							</tr>
						</thead>
						<tbody>
							@foreach ($categories as $category)
							<tr>
								<td><input type="checkbox" name="selectedRows[]" value="{{ $category->id }}"
										class="row-checkbox"></td>
								<td>{{ $loop->iteration + $categories->links()->paginator->firstItem() - 1}}</td>
								<td>{{ $category->name }}</td>
								<td>{{ $category->slug }}</td>
								<td>{{ $category->featured ? __('Yes') : __('No') }}</td>
								<!-- <td><img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                         width="32">
                                <td><img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}"
                                         width="32"> -->

								<td>
									<x-action-buttons route="news_categories" :model="$category" :show="false" />
								</td>
							</tr>
							@endforeach
							@if(count($categories)<=0) <tr>
								<td style="text-align: center" colspan="7"> {{__('No Data Yet')}}</td>
								</tr>
								@endif
						</tbody>
					</table>
				</div>
			</form>
		</div>
		{{ $categories->links() }}
	</div>
</div>
@endsection