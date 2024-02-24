@extends('layout.app')

@section('title', __('Create Page'))
@section('description', __('Create a new Page'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('New Page') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-10 offset-1" action="{{ route('site-pages.store') }}" method="POST">
                        @csrf
                        @include('site_pages._form')
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
