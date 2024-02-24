@extends('layout.app')

@section('title', __('Social Media'))
@section('description', __('Manage social media'))

@section('content')
<div class="container-fluid" style="padding-bottom: 24px">
	<Br>
	<div class="card mb-80">
		<div class="card-header color-dark fw-500">
			<h4 class="text-capitalize">{{ __('Social Media') }} ({{ $social_medias->links()->paginator->total() }})
			</h4>
			<div class="m-1 mt-3">
				<a href="{{ route('social-media.create') }}" class="btn btn-primary mb-3">{{ __('Create social media')
					}}</a>
			</div>
		</div>
		<div class="card-body">
			<x-filter :filter_attributes="[
                                'name' => 'text',
                                'url' => 'text',
                            ]" />
			<div class="table-responsive">
				<table class="table mb-20 table-borderless">
					<thead>
						<tr class="userDatatable-header">
							<th>#</th>
							<th>{{ __('Name') }}</th>
							<th>{{ __('Icon') }}</th>
							<th>{{ __('Url') }}</th>
							<th>{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($social_medias as $key => $social_media)
						<tr>
							<td>{{ $loop->iteration + $social_medias->links()->paginator->firstItem() - 1 }}</td>
							<td>{{ $social_media->name }}</td>
							<td><x-image src="{{$social_media->icon}}" /></td>
							<td>{{ $social_media->url }}</td>
							<td>
								<x-action-buttons route="social-media" :model="$social_media" :show="false" />
							</td>
						</tr>
						@endforeach
						@if(count($social_medias)<=0) <tr>
							<td style="text-align: center" colspan="6"> {{__('No Data Yet')}}</td>
							</tr>
							@endif
					</tbody>
				</table>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			{{ $social_medias->links() }}
		</div>
	</div>
</div>
@endsection