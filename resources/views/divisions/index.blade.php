@extends('layout.app')

@section('title', __('Divisions'))
@section('description', __('Manage divisions'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Divisions') }} ({{ $divisions->links()->paginator->total()}})</h4>
                <div class="m-1 mt-3">
                    <a href="{{ route('divisions.create') }}"
                       class="btn btn-primary mb-3">{{ __('Create Division') }}</a>
                </div>
            </div>
            <div class="card-body">
                <x-filter :filter_attributes="[
                                'name' => 'text',
                                'slug' => 'text',
                            ]"/>
                <a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>
                <form action="{{route('divisions.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
{{--                                <th>{{ __('Image') }}</th>--}}
{{--                                <th>{{ __('Icon') }}</th>--}}
                                <th>{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($divisions as $division)
                                <tr>
                                    <td><input type="checkbox" name="selectedRows[]" value="{{ $division->id }}"
                                               class="row-checkbox"></td>
                                    <td>{{ $loop->iteration + $divisions->links()->paginator->firstItem() - 1 }}</td>
                                    <td>{{ $division->name }}</td>
                                    <td>{{ $division->slug }}</td>
                                    <td>{{ $division->featured ? __('Yes') : __('No') }}</td>
{{--                                    <td>--}}
{{--                                        <img src="{{ asset('storage/' . $division->image) }}"--}}
{{--                                             alt="{{ $division->name }}"--}}
{{--                                             width="32">--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <img src="{{ asset('storage/' . $division->icon) }}" alt="{{ $division->name }}"--}}
{{--                                             width="32">--}}
{{--                                    </td>--}}
                                    <td>
                                        <x-action-buttons :model="$division" route="divisions" :show="false"/>
                                    </td>
                                </tr>
                            @endforeach
                            @if(count($divisions)<=0)
                                <tr>
                                    <td style="text-align: center" colspan="7"> {{__('No Data Yet')}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center">
                {{ $divisions->links()}}
            </div>
        </div>
    </div>
    </div>
@endsection
