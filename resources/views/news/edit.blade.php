@extends('layout.app')

@section('title', __('Edit News'))
@section('description', __('Edit an existing news'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit News') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form enctype="multipart/form-data" class="col-11 m-auto"
                          action="{{ route('news.update', $result->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        @include('news.partials._language-tabs')

                        <div class="form-group">
                            <label>{{ __('Image') }} <span class="text-danger"></span></label>

                            @if($result->image != null)
                                <br><br>
                                <img src="{{asset('storage/'.$result->image)}}" width="100px" alt="">
                                <br><br>
                            @endif
                            <input type="file" name="image" class="form-control">
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="tags">{{ __('Tags') }} <span class="text-danger">*</span></label>
                                <input required type="text" name="tags" class="tags form-control"
                                       data-url="{{ route('tags.api') }}" id="tags" value="{{ $newsTags }}">
                            </div>
                            <div class="col-6">
                                <label>{{ __('Categories') }} <span class="text-danger">*</span></label>
                                <select required name="categories[]" class="form-select" multiple
                                        aria-label="multiple select example">
                                    <option disabled>{{ __('Select your Categories') }}</option>
                                    @foreach(\App\Models\NewsCategory::select('id','name')->get() as $category)
                                        <option
                                            value="{{$category->id}}" {{\Illuminate\Support\Facades\DB::table('category_news_categories')->where('news_id',$result->id)->where('news_categories_id',$category->id)->first() ? "selected": ""}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary">{{ __('Edit News') }}</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

        <script>
            CKEDITOR.replace('ckeditor');
        </script>
@endsection
