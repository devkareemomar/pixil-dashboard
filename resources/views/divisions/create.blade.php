@extends('layout.app')

@section('title', __('Create Division'))
@section('description', __('Create a new division'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create Division') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-11 m-auto" action="{{ route('divisions.store') }}" method="POST"
                          enctype="multipart/form-data"
                          x-data="{ slug: '{{ old('slug') }}' }"

                    >
                        @csrf
                        <div class="form-group">
                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input required type="text" name="name" class="form-control" value="{{ old('name') }}"
                                   x-on:input="slug = $event.target.value.toLowerCase().replace(/ /g, '-')"
                            >
                            <x-error-message name="name"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Slug') }}</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" x-model="slug">
                            <x-error-message name="slug"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Featured') }}</label>
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                            <x-error-message name="featured"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Parent Category') }}</label>
                            <select name="parent_category" class="form-control" required>
                                <option value="">{{ __('Select Parent Division') }}</option>
                                @foreach ($parentCategories as $parentCategory)
                                    <option
                                        value="{{ $parentCategory->id }}" {{ old('parent_category') == $parentCategory->id ? 'selected' : '' }}>
                                        {{ $parentCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error-message name="parent_category"/>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('Image') }}<span class="text-danger">*</span></label>--}}
{{--                            <input required type="file" name="image" class="form-control">--}}
{{--                            <x-error-message name="image"/>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('Icon') }}<span class="text-danger">*</span></label>--}}
{{--                            <input required type="file" name="icon" class="form-control">--}}
{{--                            <x-error-message name="icon"/>--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-primary">{{ __('Create Division') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
