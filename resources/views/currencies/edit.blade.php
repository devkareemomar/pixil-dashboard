@extends('layout.app')

@section('title', __('Edit Currency'))
@section('description', __('Edit an existing currency'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Currency') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <form action="{{ route('currencies.update', $currency->id) }}" method="POST" class="col-11 m-auto">
                        @csrf
                        @method('PATCH')
                        <div class="dm-nav-controller">
                            <ul class="nav nav-fill flex-column flex-md-row btn-group" id="tabs-icons-text"
                                role="tablist">
                                @php
                                    $languages = \App\Models\Language::get();
                                    $languages_count = count($languages);
                                @endphp
                                @foreach($languages as $language)
                                    <li class="nav-item col-{{$languages_count > 1 ? 2 : 12}} mb-2 mb-md-0">
                                        <a class="btn btn-sm btn-outline-light color-light nav-link {{$language->is_default ? 'active':''}}"
                                           style="margin-bottom: 12px"
                                           id="tabs-icons-text-{{$language->id}}-tab" data-bs-toggle="tab"
                                           href="#tabs-icons-text-{{$language->id}}" role="tab"
                                           aria-controls="tabs-icons-text-{{$language->id}}" aria-selected="true">
                                            <img src="{{asset('storage/'.$language->flag)}}" class="img-fluid"
                                                 width="30px"
                                                 height="30px" alt="">
                                            {{$language->name}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-content" id="tabcontent2">
                            @foreach(\App\Models\Language::get() as $language)
                                @php
                                    if(isset($currency))
                                    {
                                    $currentLanguageCountry = $currency->currencyLanguage()->where('language_id',
                                    $language->id)->first();
                                    }
                                @endphp
                                <div class="tab-pane fade {{$language->is_default ? 'show active':''}} "
                                     id="tabs-icons-text-{{$language->id}}" role="tabpanel"
                                     aria-labelledby="tabs-icons-text-{{$language->id}}-tab">
                                    <div class="form-group">
                                        <label>{{ __('Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" name="currencies[{{$language->id}}][name]"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{old('name', $currentLanguageCountry->name ?? '')}}">
                                        <x-error-message name="name"/>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label>{{ __('Code') }} <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control"
                                   value="{{ old('code', $currency->code) }}">
                            <x-error-message name="code"/>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Exchange Rate') }} <span class="text-danger">*</span></label>
                            <input type="text" name="exchange_rate" class="form-control"
                                   value="{{ old('exchange_rate', $currency->exchange_rate) }}">
                            <x-error-message name="exchange_rate"/>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Edit Currency') }}</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
