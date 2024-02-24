@extends('layout.app')

@section('title', __('Edit Help Type'))
@section('description', __('Edit an existing Help Type'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Help Type') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form enctype="multipart/form-data" class="col-11 m-auto"
                          action="{{ route('help_types.update', $result->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input required type="text" name="name" class="form-control"
                                   value="{{ $result->name }}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" value="1" name="is_active"
                                       id="flexSwitchCheckChecked" {{$result->is_active ==1 ? "checked":''}}>
                                <label class="form-check-label"
                                       for="flexSwitchCheckChecked">{{ __('Is Active') }}</label>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">{{ __('Update Help Type') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
