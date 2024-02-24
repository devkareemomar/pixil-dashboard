@extends('layout.app')

@section('title', __('Create Template'))
@section('description', __('Create a new Template'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create Template') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-11 m-auto" action="{{ route('gifts.templates.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                       <div class="form-group">
                           <label>{{ __('Watermark Image') }}<span class="text-danger">*</span></label>
                           <input required type="file" name="watermark_image" class="form-control">
                           <x-error-message name="watermark_image"/>
                       </div>

                       <div class="form-group">
                        <label>{{ __('Original Image') }}<span class="text-danger">*</span></label>
                        <input required type="file" name="original_image" class="form-control">
                        <x-error-message name="original_image"/>
                    </div>
                        <button type="submit" class="btn btn-primary">{{ __('Create Template') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
