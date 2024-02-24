@extends('layout.app')

@section('title', __('Create Language'))
@section('description', __('Create a new language'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create New Language') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('languages.store') }}" method="POST" enctype="multipart/form-data" class="col-11 m-auto ">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Short Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="short_name" class="form-control" value="{{ old('short_name') }}">
                            @error('short_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Flag') }} <span class="text-danger">*</span></label>
                            <input type="file" name="flag" class="form-control-file">
                            <small class="text-muted">{{ __('Size') }}: 32x32 or 64x64</small>
                            @error('flag')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Is Default') }}</label>
                            <input type='hidden' value='0' name='is_default'>
                            <input value="1" type="checkbox" name="is_default" class="form-check-input" {{ old('is_default')
                        ? 'checked' : '' }}>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('Translation File') }}</label>--}}
{{--                            <input type="file" name="translation_file" class="form-control-file">--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-primary">{{ __('Create Language') }}</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
