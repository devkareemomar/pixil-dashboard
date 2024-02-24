@extends('layout.app')

@section('title', __('Create News'))
@section('description', __('Create a new news'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >

        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Create New News') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <form enctype="multipart/form-data" class="col-11 m-auto " action="{{ route('news.store') }}" method="POST">
                        @csrf
                        @include('news.partials._language-tabs')
                        <div class="form-group">
                            <label>{{ __('Image') }} <span class="text-danger">*</span></label>
                            <input required type="file" name="image" class="form-control" value="{{ old('image') }}">
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label>{{ __('Tags') }} <span class="text-danger">*</span></label>
                                <input required type="text" name="tags" class="tags form-control"
                                       data-url="{{ route('tags.api') }}">
                            </div>
                            <div class="col-6">
                                <label>{{ __('Categories') }} <span class="text-danger">*</span></label>
                                <select required name="categories[]" class="form-select" multiple aria-label="multiple select example">
                                    <option disabled>{{ __('Select your Categories') }}</option>
                                    @foreach(\App\Models\NewsCategory::select('id','name')->get() as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary">{{ __('Create News') }}</button>
                        <br><Br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
