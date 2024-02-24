@extends('layout.app')

@section('title', __('Show Status'))
@section('description', __('Edit an existing Status'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h2>{{ __('Status') }} </h2>
            </div>
            <div class="card-body">
                <div class="row  pt-30">

                    <div class="col-12">
                        <div class="row " >
                            <div class="col-4">
                                <h4 style="display: inline-block">{{ __('Project Name') }} :</h4>
                                {!! $result->project->name !!}
                            </div>
                            <div class="col-4">
                        <h4 style="display: inline-block">{{ __('Status Name') }} :</h4>
                        {!! $result->status_name !!}
                            </div>
                            <div class="col-4">
                                <h4 style="display: inline-block">{{ __('Is Active') }} :</h4>
                                {!! $result->active == 1 ? __('Active') : __('Not Active') !!}
                            </div>

                            <hr style="margin:2% 0">
                            <div>
                                <x-filter :filter_attributes="[
                                'national_id' => 'number',
                                'created_at' => 'date',
                                'status' => ['Under review' => __('Under review'), 'It has been approved' => __('It has been approved'),'access denied' => __('access denied')],
                            ]"/>
                                <div class="table-responsive">
                                    <table class="table mb-20 table-borderless">
                                        <thead>
                                        <tr class="userDatatable-header">
                                            <th>{{__('Order Number')}}</th>
                                            <th>{{__('National ID')}}</th>
                                            <th>{{__('Project Name')}}</th>
                                            <th>{{__('Status Name')}}</th>
                                            <th>{{__('Create At')}}</th>
                                            <th>{{__('Status')}}</th>
                                            <th>{{__('Check`s Price')}}</th>
                                            <th>{{__('Check`s Date')}}</th>
                                            <th>{{ __('Actions') }}</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($result->formData as $form_data)
                                            <tr>

                                                <td>{{ $form_data->id }}</td>
                                                <td>{{ $form_data->national_id }}</td>
                                                <td>{{$result->project->name ?? ''}}</td>
                                                <td>{{$result->status_name}}</td>
                                                <td>{{ $form_data->created_at }}</td>
                                                <td>{{  __($form_data->status) }}</td>
                                                <td>{{ $form_data->price?: '-' }}</td>
                                                <td>{{$form_data->checks_date ?: '-'}}</td>

                                                <td>
                                                    <x-action-buttons :model="$form_data" route="formData"
                                                                      :edit="false">
                                                    </x-action-buttons>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if(count($result->formData)<=0)
                                            <tr>
                                                <td style="text-align: center" colspan="10"> {{__('No Data Yet')}}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <Br>
            </div>
        </div>
    </div>
@endsection
