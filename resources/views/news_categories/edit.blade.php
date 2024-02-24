@extends('layout.app')

@section('title', __('Edit News Category'))
@section('description', __('Edit an existing News category'))

@section('content')
    <div class="container-fluid pb-30 pt-30">

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit News Category') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form class="col-11 m-auto" action="{{ route('news_categories.update', $category->id) }}"
                          method="POST" enctype="multipart/form-data"  x-data="{ slug: '{{ old('slug', $category->slug) }}' }">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $category->name) }}"  x-on:input="slug = $event.target.value.toLowerCase().replace(/ /g, '-')">
                            <x-error-message name="name"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Slug') }}</label>
                            <input type="text" name="slug" class="form-control"
                                   value="{{ old('slug', $category->slug) }}" x-model="slug">
                            <x-error-message name="slug"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Featured') }}</label>
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" name="featured"
                                   value="1" {{ old('featured', $category->featured) ? 'checked' : '' }}>
                            <x-error-message name="featured"/>
                        </div>
                        <!-- <div class="form-group">
                            <label>{{ __('Image') }}</label>
                            <input type="file" name="image" class="form-control">
                            <x-error-message name="image"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Icon') }}</label>
                            <input type="file" name="icon" class="form-control">
                            <x-error-message name="icon"/>
                        </div> -->
                        <button type="submit" class="btn btn-primary">{{ __('Update News Category') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
