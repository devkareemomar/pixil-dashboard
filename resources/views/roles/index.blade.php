@extends('layout.app')

@section('title', __('Roles'))
@section('description', __('Manage roles'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Roles') }}({{ $roles->links()->paginator->total() }})</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('roles.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a href="{{ route('roles.create') }}" style="display: inline-block" class="btn btn-primary mb-3">{{
					__('Create Role') }}</a>
			</div>
		</div>
		<div class="card-body">
			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('roles.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
								<th>{{ __('Permissions') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($roles as $key=>$role)
							<tr>
								<th><input type="checkbox" name="selectedRows[]" value="{{ $role->id }}"
										class="row-checkbox"></th>
								<td>{{ $loop->iteration + $roles->links()->paginator->firstItem() - 1}}</td>
								<td>{{ $role->name }}</td>
								<td>{{ substr(implode(', ', $role->permissions->pluck('name')->toArray()), 0, 50) .
									'...' }}</td>
								<td>
									<x-action-buttons route="roles" :model="$role" :show="false" />
								</td>
							</tr>
							@empty
							<tr>
								<td style="text-align: center" colspan="3"> {{__('No Data Yet')}}</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<div class="d-flex justify-content-center">
			{{ $roles->links() }}
		</div>
	</div>
</div>
@endsection