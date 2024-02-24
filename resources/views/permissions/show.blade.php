@extends('layouts.app')

@section('content')
    <h1>{{ __('Permission Details') }}</h1>

    <p><strong>{{ __('Name') }}:</strong> {{ $permission->name }}</p>

    <a href="{{ route('permissions.edit', $permission->id) }}">{{ __('Edit') }}</a>
@endsection
