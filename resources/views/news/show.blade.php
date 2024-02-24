@extends('layout.app')

@section('title', __('Edit News'))
@section('description', __('Edit an existing news'))

@section('content')
    <div class="container-fluid pb-30 pt-30"  >
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h2>{{ __('News') . ( $result?->currentLanguage()?->title ?? $result?->title ) }}</h2>
            </div>

                <div class="card-body row">
                    <div class="col-3">
                        <img width="90%" style="border-radius: 10px" src="{{ asset('storage/'.$result->image) }}">
                    </div>
                    <div class="col-8">
                        <h2>{{ __('Short Description') }}:</h2>
                        <p>{{ $result?->currentLanguage()?->short_description ?? $result?->short_description }}</p>

                        <div class="row">
                            <div class="col-6">
                                <h4>{{ __('Categories') }}:</h4>
                                @foreach ($result->categories as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </div>
                            <div class="col-6">
                                <h4>{{ __('Tags') }}:</h4>
                                @foreach ($result->tags as $tag)
                                    <li>{{ $tag->name }}</li>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-11 m-auto">
                        <h2>{{ __('Description') }}:</h2>
                        <br>
                        {!! $result?->currentLanguage()?->description ?? $result?->description !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
