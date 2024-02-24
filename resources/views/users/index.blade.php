@extends('layout.app')

@section('title', __('Users'))
@section('description', __('Manage users'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">
				{{ __('User List') }} ({{ $users->links()->paginator->total() }})
			</h4>
			<div class="m-1 mt-3">
				<a class="btn btn-secondary mb-3" style="display: inline-block"
					href="{{route('users.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

				<a href="{{ route('users.create') }}" style="display: inline-block" class="btn btn-primary mb-3">{{
					__('Create User') }}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'name' => 'text',
                                'email' => 'text',
                                'username' => 'test',
                                'role_id' => $roles,
                            ]" />
			<a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

			<form action="{{route('users.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
								<th>{{ __('Email') }}</th>
								<th>{{ __('Username') }}</th>
								<th>{{ __('Role') }}</th>
								<th>{{ __('Status') }}</th>
								<th>{{ __('Actions') }}</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($users as $key=>$user)
							<tr>
								<th><input type="checkbox" name="selectedRows[]" value="{{ $user->id }}"
										class="row-checkbox"></th>
								<td>{{$loop->iteration + $users->links()->paginator->firstItem() - 1}}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->username }}</td>
								<td>{{ $user->role?->name }}</td>
								<td>{{ $user->status }}</td>
								<td>
									<x-action-buttons route="users" :model="$user" :show="false" />
								</td>
							</tr>
							@empty
							<tr>
								<td style="text-align: center" colspan="6"> {{__('No Data Yet')}}</td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</form>
		</div>
		<div class="d-flex justify-content-center">
			{{ $users->links() }}
		</div>
	</div>
</div>
@endsection