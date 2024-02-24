@extends('layout.app')

@section('title', __('Add New Project'))
@section('description', __('Create a new project'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Add New Project') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <form action="{{ route('projects.store') }}" method="post" enctype="multipart/form-data"
                          class="col-11 m-auto ">
                        @csrf
                        @include('projects.partials._form')
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Create Project') }}</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
