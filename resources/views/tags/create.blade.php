@extends('layout.app')

@section('title', __('Create tag'))
@section('description', __('Create a new tag'))

@section('content')
    <div class="container-fluid pb-30 pt-30">

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create tag') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-11 m-auto" action="{{ route('tags.store') }}" method="POST"
                          x-data="{ slug: '{{ old('slug') }}' }"

                    >
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                   x-on:input="slug = $event.target.value.toLowerCase().replace(/ /g, '-')"
                            >
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Slug') }} <span class="text-danger">*</span></label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}"
                                   x-model="slug"
                            >
                            @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Create tag') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
