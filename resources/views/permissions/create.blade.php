@extends('layouts.app')

@section('content')
    <h1>{{ isset($permission) ? __('Edit Permission') : __('Create Permission') }}</h1>

    <form action="{{ isset($permission) ? route('permissions.update', $permission->id) : route('permissions.store') }}" method="POST">
        @csrf
        @if(isset($permission))
            @method('PUT')
        @endif

        <label for="name">{{ __('Name') }}:</label>
        <input type="text" name="name" value="{{ old('name', isset($permission) ? $permission->name : '') }}">

        <button type="submit">{{ isset($permission) ? __('Update') : __('Create') }}</button>
    </form>
@endsection
