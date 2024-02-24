@extends('layout.app')

@section('title', __('Edit page'))
@section('description', __('Edit a new page'))

@section('content')
    <div class="container-fluid pb-30 pt-30">

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit page') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-11 m-auto" action="{{ route('pages.update', $page->id) }}" method="POST"
                          enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')
                        @include('pages.partials._form')
                        <button type="submit" class="btn btn-primary">{{ __('Edit page') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
