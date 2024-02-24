@extends('layout.app')

@section('title', __('Edit Language'))
@section('description', __('Edit an existing language'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Language') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('languages.update', $language->id) }}" method="POST"
                          enctype="multipart/form-data" class="col-11 m-auto ">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $language->name) }}">
                            <x-error-message name="name"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Short Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="short_name" class="form-control"
                                   value="{{ old('short_name', $language->short_name) }}">
                            <x-error-message name="short_name"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Flag') }}</label>
                            <input type="file" name="flag" class="form-control-file">
                            <x-image src="{{$language->flag}}"/>
                            <small class="text-muted">{{ __('Size') }}: 32x32 or 64x64</small>
                            <x-error-message name="flag"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Is Default') }}</label>
                            <input type='hidden' value='0' name='is_default'>
                            <input value="1" type="checkbox" name="is_default" class="form-check-input" {{ old('is_default',
                        $language->is_default) ? 'checked' : '' }}>
                            <x-error-message name="is_default"/>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('Translation File') }}</label>--}}
{{--                            <input type="file" name="translation_file" class="form-control-file">--}}
{{--                            <x-error-message name="translation_file"/>--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-primary">{{ __('Edit Language') }}</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
