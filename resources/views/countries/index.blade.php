@extends('layout.app')

@section('title', __('Countries'))
@section('description', __('View and manage countries'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Countries') }} ({{ $countries->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">
                    <a class="btn btn-secondary mb-3" style="display: inline-block"
                       href="{{route('countries.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

                    <a href="{{ route('countries.create') }}" style="display: inline-block"
                       class="btn btn-primary mb-3">{{ __('Create Country') }}</a>
                </div>
            </div>
            <div class="card-body">
                <x-filter :filter_attributes="[
                                'name' => 'text',
                                'short_name' => 'text',
                                'language_id' => $languages,
                                'currency_id' => $currencies,
                            ]"/>
                <a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

                <form action="{{route('countries.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
                            <th>{{ __('Language') }}</th>
                            <th>{{ __('Currency') }}</th>
                            <th>{{ __('Flag') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($countries as $key=>$country)
                            <tr>
                                <th><input type="checkbox" name="selectedRows[]" value="{{ $country->id }}"
                                           class="row-checkbox"></th>
                                <td>{{ $loop->iteration + $countries->links()->paginator->firstItem() - 1}}</td>
                                <td>{{ $country->name }}</td>
                                <td>{{ $country->short_name }}</td>
                                <td>{{ $country->language?->name }}</td>
                                <td>{{ $country->currency?->name }}</td>
                                <td><img src="{{ asset('storage/' . $country->flag) }}"
                                         alt="{{ $country->name }} {{ __('Flag') }}" width="32">
                                <td>
                                    <x-action-buttons route="countries" :model="$country" :show="false"/>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td style="text-align: center" colspan="7"> {{__('No Data Yet')}}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center">
            {{ $countries->links() }}
            </div>

        </div>
    </div>
@endsection
