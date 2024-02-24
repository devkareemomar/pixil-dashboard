@extends('layout.app')

@section('title', __('Show Help List'))
@section('description', __('Edit an existing Help'))

@section('content')
    <style>
        .col-6 {
            padding-bottom: 20px;
        }
    </style>
    <div class="container-fluid" style="padding: 1%">

        <div class="card mb-80">
            <div class="card-body">
                <div class="row">
                    <div style="padding: 1%;text-align: center">
                        <h2 style="display: inline-block">{{ __('Help Name') }} ( {{$result->name}} ) </h2>
                        @if($result->file != null)
                            <a download href="{{asset('storage/'.$result->file)}}"><img width="50px" src="{{asset('assets/img/download.png')}}"></a>
                        @endif
                        <br>
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Nationality') }} :</h2>
                        {!! $result->nationality->name !!}
                    </div>
                    <div class="col-6">
                        <h2>{{ __('Service Status') }} :</h2>
                        {!! $result->service_status!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Gender') }} :</h2>
                        {!! $result->gender !!}
                    </div>
                    <div class="col-6">
                        <h2>{{ __('Marital Status') }} :</h2>
                        {!! $result->marital_status!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Civil ID') }} :</h2>
                        {!! $result->civil_id !!}
                    </div>
                    <div class="col-6">
                        <h2>{{ __('Help Type') }} :</h2>
                        {!! $result->help_type->name!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Family Members') }}:</h2>
                        {!! $result->family_members!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Job') }} :</h2>
                        {!! $result->job!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Salary') }} :</h2>
                        {!! $result->salary!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Phone') }} :</h2>
                        {!! $result->phone!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Address') }} :</h2>
                        {!! $result->address!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Other Information') }} :</h2>
                        {!! $result->other_information!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Old Help Document') }} :</h2>
                        {!! $result->old_help_document!!}
                    </div>

                    <div class="col-6">
                        <h2>{{ __('Reference No') }} :</h2>
                        {!! $result->reference_no!!}
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>

@endsection
