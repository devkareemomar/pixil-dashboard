@extends('layout.app')

@section('title', __('Edit User'))
@section('description', __('Edit an existing user'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit User') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" class="col-11 m-auto">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}">
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}">
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">{{ __('Username') }}</label>
                            <input type="text" name="username" class="form-control"
                                   value="{{ old('username', $user->username) }}">
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control"
                                   value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="form-group">
                            <label for="role_id">{{ __('Role') }}</label>
                            <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : ''
							}}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Update User') }}</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
