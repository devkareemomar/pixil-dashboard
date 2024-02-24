@extends('layout.app')

@section('title', __('Currencies'))
@section('description', __('Manage currencies'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Currencies') }} ({{ $currencies->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">
                    <a class="btn btn-secondary mb-3" style="display: inline-block"
                       href="{{route('currencies.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>

                    <a href="{{ route('currencies.create') }}" style="display: inline-block"
                       class="btn btn-primary mb-3">{{ __('Create Currency') }}</a>
                </div>
            </div>
            <div class="card-body">
                <x-filter :filter_attributes="[
                                'name' => 'text',
                                'code' => 'text',
                            ]"/>
                <a id="show" class="m-1 hover-me-smooth text-dark" style="cursor: pointer;">
				<i class="fa fa-caret-down"></i>
				<label class="form-check-label">{{ __('Advanced Options') }}</label>
			</a>

                <form action="{{route('currencies.deleteSelectRow')}}" enctype="multipart/form-data" method="post">
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
                            <th>{{ __('Code') }}</th>
                            <th>{{ __('Exchange Rate') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($currencies as $currency)
                            <tr>
                                <td><input type="checkbox" name="selectedRows[]" value="{{ $currency->id }}"
                                           class="row-checkbox"></td>
                                <td>{{ $loop->iteration  + $currencies->links()->paginator->firstItem() - 1 }}</td>
                                <td>{{ $currency->name }}</td>
                                <td>{{ $currency->code }}</td>
                                <td>{{ $currency->exchange_rate }}</td>
                                <td>
                                    <x-action-buttons route="currencies" :model="$currency" :show="false"/>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td style="text-align: center" colspan="5"> {{__('No Data Yet')}}</td>
                        @endforelse
                        </tbody>
                    </table>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center">
            {{ $currencies->links() }}
            </div>
        </div>
    </div>
    </div>
@endsection
