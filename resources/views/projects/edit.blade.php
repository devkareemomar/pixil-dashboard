@extends('layout.app')

@section('title', __('Edit Project'))
@section('description', __('Edit an existing project'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Project') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('projects.update', $project->id) }}" method="post"
                          enctype="multipart/form-data" class="col-11 m-auto ">
                        @csrf
                        @method('PUT')
                        @include('projects.partials._form')
                        <button type="submit" class="btn btn-primary">{{ __('Update Project') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

