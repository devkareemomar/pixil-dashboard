@extends('layout.app')

@section('title', __('Edit Division'))
@section('description', __('Edit an existing division'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Division') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <form class="col-11 m-auto" action="{{ route('divisions.update', $division->id) }}" method="POST" enctype="multipart/form-data"                              x-data="{ slug: '{{ old('slug', $currentLanguageProject->slug ?? '') }}' }"
                          x-data="{ slug: '{{ old('slug', $division->slug) }}' }"
                    >
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $division->name) }}"
                                   x-on:input="slug = $event.target.value.toLowerCase().replace(/ /g, '-')"
                            >
                            <x-error-message name="name"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Slug') }}</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $division->slug) }}"
                                   x-model="slug"
                            >
                            <x-error-message name="slug"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Featured') }}</label>
                            <input type="hidden" name="featured" value="0" >
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $division->featured) ? 'checked' : '' }}>
                            <x-error-message name="featured"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Parent Category') }}</label>
                            <select name="parent_category" class="form-control" required>
                                <option value="">{{ __('Select Parent Division') }}</option>
                                @foreach ($parentCategories as $parentCategory)
                                    <option value="{{ $parentCategory->id }}" {{ old('parent_category', $division->parent_category) == $parentCategory->id ? 'selected' : '' }}>
                                        {{ $parentCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error-message name="parent_category"/>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('Image') }}</label>--}}
{{--                            <input  type="file" name="image" class="form-control">--}}
{{--                            <img src="{{ asset('storage/' . $division->image) }}" alt="{{ $division->name }}" width="32">--}}
{{--                            <x-error-message name="image"/>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>{{ __('Icon') }}</label>--}}
{{--                            <input  type="file" name="icon" class="form-control">--}}
{{--                            <img src="{{ asset('storage/' . $division->icon) }}" alt="{{ $division->name }}" width="32">--}}
{{--                            <x-error-message name="icon"/>--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-primary">{{ __('Edit Division') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
