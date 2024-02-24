@extends('layout.app')

@section('title', __('Audit log'))
@section('description', __('View audit log'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Audit log') }} ({{ $audits->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">
                    <a class="btn btn-secondary mb-3" style="display: inline-block"
                       href="{{route('audits.export',request()->getQueryString())}}"> {{__('Export Data')}}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-20 table-borderless">
                        <thead>
                        <tr class="userDatatable-header">
                            <th>#</th>
                            <th>{{ __('User') }}</th>
                            <th>{{ __('Event') }}</th>
                            <th>{{ __('Timestamp') }}</th>
                            <th>{{__('IP')}}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($audits as $audit)
                            <tr>
                                <td>{{ $audit->id }}</td>
                                <td>{{$audit->user?->name}}</td>
                                <td>{{ __('User') . ' ' . $audit->user?->name . ' ' .  __('has') . ' ' . __($audit->event) . ' ' . __('on') . ' ' . __('Table') . ' ' . __(class_basename($audit->auditable_type)) . ' ' . __('with id') . ' ' . $audit->auditable_id }}</td>
                                <td>{{ $audit->created_at }}</td>
                                <td>{{ $audit->ip_address }}</td>
                                <td>
                                    <x-action-buttons :model="$audit" route="audits" :edit="false" :delete="false"/>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $audits->links()}}
                </div>
            </div>
        </div>

    </div>
    </div>

@endsection
