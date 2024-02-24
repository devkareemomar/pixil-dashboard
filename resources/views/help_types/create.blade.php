@extends('layout.app')

@section('title', __('Create Help Type'))
@section('description', __('Create a new help type'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create New Help Type') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form enctype="multipart/form-data" class="col-11 m-auto" action="{{ route('help_types.store') }}"
                          method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input required type="text" name="name" class="form-control"
                                   value="{{ old('name') }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="1" role="switch"
                                       id="flexSwitchCheckChecked" name="is_active" checked>
                                <label class="form-check-label"
                                       for="flexSwitchCheckChecked">{{ __('is Active') }}</label>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">{{ __('Create Help Type') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
