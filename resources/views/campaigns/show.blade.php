@extends('layout.app')

@section('title', __('Show Campaigns'))
@section('description', __('Edit an existing Campaigns'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h2>{{ __('Campaign') }} ({{ $result->title }})</h2>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-3">
                        <img width="90%" style="border-radius: 10px" src="{{ asset('storage/' . $result->image) }}">
                    </div>
                    <div class="col-8">
                        <h2>{{ __('Description') }} :</h2>
                        {!! $result->description !!}
                        <br><br>
                        <h2>{{ __('Slogan') }}</h2>
                        {!! $result->slogan !!}
                        <br><br>
                        <div class="row">
                            <div class="col-6">
                                <h4>{{ __('Start date') }}</h4>
                                {!! $result->start_date !!}
                            </div>
                            <div class="col-6">
                                <h4>{{ __('End date') }}</h4>
                                {!! $result->end_date !!}
                            </div>
                            <br><br><br><br>
                            <div class="col-6">
                                <h4>{{ __('Is Active') }}</h4>
                                {!! $result->is_active == 1 ? __('Active') : __('Not Active') !!}
                            </div>
                            <div class="col-6">
                                <h4>{{ __('Is Home Slider') }}</h4>
                                {!! $result->is_home_slider == 1 ? __('Active') : __('Not Active') !!}
                            </div>
                            <br><br><br><br>
                            <div>
                                <h2>{{ __('Projects') }}</h2>
                                @foreach($result['projects'] as $project)
                                    <li> {!! $project->name !!}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <Br>
            </div>
        </div>
    </div>
@endsection
