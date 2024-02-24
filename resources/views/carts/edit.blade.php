@extends('layout.app')

@section('title', __('Edit Cart'))
@section('description', __('Edit an existing cart'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Cart') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">

                <form class="col-11 m-auto" action="{{ route('carts.update', $cart->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="user_id">{{ __('User Name') }}</label>
                        <select disabled name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            <option value="">{{ __('Select User') }}</option>
                            @foreach ($users as $user)
                                <option
                                    value="{{ $user->id }}" {{ old('user_id', $cart->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label  for="session_id">{{ __('Session ID') }}</label>
                        <input disabled type="text" name="session_id" class="form-control"
                               value="{{ old('session_id', $cart->session_id) }}">
                        @error('session_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="total_amount">{{ __('Total Amount') }}</label>
                        <input type="text" name="total_amount" class="form-control"
                               value="{{ old('total_amount', $cart->total_amount) }}">
                        @error('total_amount')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="client_notes">{{ __('Client Notes') }}</label>
                        <textarea name="client_notes"
                                  class="form-control">{{ old('client_notes', $cart->client_notes) }}</textarea>
                        @error('client_notes')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="admin_notes">{{ __('Admin Notes') }}</label>
                        <textarea name="admin_notes"
                                  class="form-control">{{ old('admin_notes', $cart->admin_notes) }}</textarea>
                        @error('admin_notes')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Update Cart') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
