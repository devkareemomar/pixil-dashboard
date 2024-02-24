@extends('layout.app')

@section('title', __('Sliders'))
@section('description', __('Manage sliders'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Sliders') }} ({{ $sliders->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">
                    <a href="{{ route('sliders.create') }}" class="btn btn-primary mb-3">{{ __('Create slider') }}</a>
                </div>
            </div>
            <div class="card-body">
                <x-filter :filter_attributes="[
                                'title' => 'text',
                                'description' => 'text',
                                'media_type' => [ 'image' => __('Image'), 'video' => __('Video') ],
                                'media_path' => 'text'
                            ]"/>
                <a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>
                <form action="{{route('sliders.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Media type') }}</th>
                                <th>{{ __('Media path') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sliders as $key => $slider)
                                <tr>
                                    <td><input type="checkbox" name="selectedRows[]" value="{{ $slider->id }}"
                                               class="row-checkbox"></td>
                                    <td>{{ $loop->iteration + $sliders->links()->paginator->firstItem() - 1 }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>{{ $slider->media_type }}</td>
                                    <td>
                                        <a target="_blank" href="{{ $slider->media_path }}">
                                            <img width="50px" src="{{asset('assets/img/download.png')}}">
                                        </a>
                                    </td>
                                    <td>
                                        <x-action-buttons route="sliders" :model="$slider" :show="false"/>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($sliders)<=0)
                                <tr>
                                    <td style="text-align: center" colspan="6"> {{__('No Data Yet')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center">
                {{ $sliders->links() }}
            </div>
        </div>
    </div>
@endsection
