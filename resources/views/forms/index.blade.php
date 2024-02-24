@extends('layout.app')

@section('title', __('Statuses'))
@section('description', __('Manage Status'))

@section('content')
    <div class="container-fluid" style="padding-bottom: 24px">
        <Br>
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Statuses') }} ({{ $results->links()->paginator->total() }})</h4>
                <div class="m-1 mt-3">

                    <a href="{{ route('forms.create') }}" style="display: inline-block"
                       class="btn btn-primary mb-3">{{ __('Create Status') }}</a>
                </div>
            </div>
            <div class="card-body">
                <x-filter :filter_attributes="[
                                'project_name' => 'text',
                                'status_name' => 'text',
                                'is_active' => [1 => __('Active'), 0 => __('Not Active')],
                            ]"/>
                <div class="table-responsive">
                    <table class="table mb-20 table-borderless">
                        <thead>
                        <tr class="userDatatable-header">
                            <th>#</th>
                            <th>{{ __('Project Name') }}</th>
                            <th>{{ __('Language') }}</th>
                            <th>{{ __('Status Name') }}</th>
                            <th>{{ __('Is active') }}</th>
                            <th>{{__('Create At')}}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($results as $key=>$form)
                            <tr>

                                <td>
                                    {{ $loop->iteration + $results->links()->paginator->firstItem() - 1 }}
                                </td>
                                <td>{{ $form->project?->name }}</td>
                                <td>{{ $form->locale }}</td>
                                <td>{{ $form->status_name }}</td>
                                <td>{{ $form->active == 1 ? __('Active') : __('Not Active') }}</td>
                                <td>{{ date('d-m-Y', strtotime($form->created_at)) }}</td>
                                <td>
                                    <x-action-buttons :model="$form" route="forms" >
                                    </x-action-buttons>
                                </td>
                            </tr>
                        @endforeach
                        @if(count($results)<=0)
                            <tr>
                                <td style="text-align: center" colspan="5"> {{__('No Data Yet')}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $results->links() }}
            </div>

        </div>
    </div>

@endsection
