@extends('layout.app')

@section('title', __('Create Country'))
@section('description', __('Create a new country'))

@section('content')
<div class="container-fluid pb-30 pt-30">
    <div class="card mb-80">
        <div class="card-header color-dark fw-500">
            <h4>{{ __('Create New Country') }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <form action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data" class="col-11 m-auto">
                    @csrf

                    <div class="dm-nav-controller">
                        <ul class="nav nav-fill flex-column flex-md-row btn-group" id="tabs-icons-text" role="tablist">
                            @php
                            $languages = \App\Models\Language::get();
                            $languages_count = count($languages);
                            @endphp
                            @foreach($languages as $language)
                            <li class="nav-item col-{{$languages_count > 1 ? 2 : 12}} mb-2 mb-md-0">
                                <a class="btn btn-sm btn-outline-light color-light nav-link {{$language->is_default ? 'active':''}}" style="margin-bottom: 12px" id="tabs-icons-text-{{$language->id}}-tab" data-bs-toggle="tab" href="#tabs-icons-text-{{$language->id}}" role="tab" aria-controls="tabs-icons-text-{{$language->id}}" aria-selected="true">
                                    <img src="{{asset('storage/'.$language->flag)}}" class="img-fluid" width="30px" height="30px" alt="">
                                    {{$language->name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="tab-content" id="tabcontent2">
                        @foreach(\App\Models\Language::get() as $language)
                        <div class="tab-pane fade {{$language->is_default ? 'show active':''}} " id="tabs-icons-text-{{$language->id}}" role="tabpanel" aria-labelledby="tabs-icons-text-{{$language->id}}-tab">
                            <div class="form-group">
                                <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="countries[{{$language->id}}][name]" class="form-control @error('name') is-invalid @enderror">
                                <x-error-message name="name" />
                            </div>

                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>{{ __('Short Name') }}</label>
                        <input type="text" name="short_name" class="form-control @error('short_name') is-invalid @enderror" value="{{ old('short_name') }}">
                        <x-error-message name="short_name" />
                    </div>
                    <div class="form-group">
                        <label>{{ __('Language') }}</label>
                        <select name="language_id" class="form-control">
                            <option value="">{{ __('Select Language') }}</option>
                            @foreach ($languages as $language)
                            <option value="{{ $language->id }}" @selected(old('language_id')==$language->id)>{{ $language->name }}</option>
                            @endforeach
                        </select>
                        <x-error-message name="language_id" />
                    </div>
                    <div class="form-group">
                        <label>{{ __('Currency') }}</label>
                        <select name="currency_id" class="form-control">
                            <option value="">{{ __('Select Currency') }}</option>
                            @foreach ($currencies as $currency)
                            <option value="{{ $currency->id }}" @selected(old('currency_id')==$currency->id) >{{ $currency->name }}</option>
                            @endforeach
                        </select>
                        <x-error-message name="currency_id" />
                    </div>
                    <div class="form-group">
                        <label>{{ __('Flag') }} <span class="text-danger">*</span></label>
                        <input type="file" name="flag" class="form-control @error('flag') is-invalid @enderror">
                        <small class="text-muted">{{ __('Size') }}: 32x32 or 64x64</small>
                        <x-error-message name="flag" />
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create Country') }}</button>
                </form>
            </div>
        </div>
    </div>
    @endsection