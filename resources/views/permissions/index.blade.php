@extends('layout.app')

@section('title', __('Permissions'))
@section('description', __('Manage permissions'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-capitalize">{{ __('Permission Management') }}</h4>
            </div>
        </div>
        <div class="card mb-50">
            <div class="card-header color-dark fw-500">
                {{ __('Permission List') }}
            </div>
            <div class="card-body">
                <ul>
                    @foreach ($permissions as $permission)
                        <li>{{ $permission->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
