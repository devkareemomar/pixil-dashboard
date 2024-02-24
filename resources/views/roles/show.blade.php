@extends('layouts.app')

@section('content')
    <h1>{{ __('Role Details') }}</h1>

    <p><strong>{{ __('Name') }}:</strong> {{ $role->name }}</p>

    <p><strong>{{ __('Permissions') }}:</strong></p>
    <ul>
        @foreach($role->permissions as $permission)
            <li>{{ $permission->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('roles.edit', $role->id) }}">{{ __('Edit') }}</a>
@endsection
