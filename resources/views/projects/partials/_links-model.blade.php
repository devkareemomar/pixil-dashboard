@php
$users = \App\Models\User::all();
@endphp
<div class="modal fade" id="exampleModalLinks-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLinksLabel"
	aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLinksLabel"> {{__('Links')}}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div>
				<p>
					<a data-bs-toggle="collapse" href="#addLinksToTheProject" role="button" aria-expanded="false"
						aria-controls="addLinksToTheProject" class="p-10">
						<i class="fa fa-plus"></i>
						{{__('add links to the project')}}
					</a>
				</p>
				<div class="collapse" id="addLinksToTheProject">
					<form enctype="multipart/form-data" class="col-11 m-auto p-10" action="{{ route('links.store') }}"
						method="POST">
						@csrf
						<input name="project_id" type="hidden" value="{{$project->id}}">
						<div class="form-group">
							<label>{{ __('Code') }} <span class="text-danger">*</span></label>
							<input required type="text" name="code" class="form-control" value="{{ old('code') }}">
							@error('code')
							<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group">
							<label>{{ __('Platform') }}</label>
							<input type="text" name="platform" class="form-control" value="{{ old('platform') }}">
							@error('platform')
							<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<div class="form-group">
							<label>{{ __('User') }}</label>
							<select name="user_id" class="form-control">
								<option disabled>{{ __('Select your user') }}</option>
								@foreach ($users as $user)
								<option value="{{ $user->id }}" @selected(old('user_id')==$user->id)
									{{ $user->name }}
								</option>
								@endforeach
							</select>
						</div>
						<button type="submit" class="btn btn-primary">{{ __('Create Link') }}</button>
					</form>
				</div>
				<p>
					<a data-bs-toggle="collapse" href="#generateLinksToTheProject" role="button" aria-expanded="false"
						aria-controls="generateLinksToTheProject" class="p-10">
						<i class="fa fa-bolt"></i>
						{{__('generate links to the project')}}
					</a>
				</p>
				<div class="collapse" id="generateLinksToTheProject">
					<form enctype="multipart/form-data" class="col-11 m-auto p-10"
						action="{{ route('links.generate',$project) }}" method="POST">
						@csrf
						<input name="project_id" type="hidden" value="{{$project->id}}">
						<div class="form-group">
							<label>{{ __('Count') }} <span class="text-danger">*</span></label>
							<input required type="text" name="count" class="form-control" value="{{ old('count') }}">
							@error('count')
							<p class="text-danger">{{ $message }}</p>
							@enderror
						</div>
						<button type="submit" class="btn btn-primary">{{ __('Create Link') }}</button>
					</form>
				</div>
			</div>
			<div>
				<div class="table-responsive">
					<table class="table mb-20 table-borderless">
						<thead>
							<tr class="userDatatable-header">
								<th>#</th>
								<th>{{ __('Code') }}</th>
								<th>{{ __('Url') }}</th>
								<th>{{ __('Platform') }}</th>
								<th>{{ __('Actions') }}</th>
								<th>{{ __('Amount') }}</th>
							</tr>
						</thead>
						<tbody>

							@forelse ($project->links ?? [] as $key=>$result)

							<tr>
								<td>{{ $loop->iteration +
									$project->links()->paginate()->links()->paginator->firstItem() - 1}}</td>
								<td>{{ $result->code}}</td>
								<td>{{ $result->url}}</td>
								<td>{{$result?->platform }}
								<td>{{$result?->amount }}
								</td>
								<td>
									<x-action-buttons route="links" :model="$result" :show="false" />
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
			</div>
		</div>
	</div>
</div>