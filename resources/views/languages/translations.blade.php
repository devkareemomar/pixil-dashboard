@extends('layout.app')

@section('title', __('Edit Translation'))
@section('description', __('Edit an existing translation'))

@section('content')
    <div class="container-fluid pb-30 pt-30">
        <div class="card mb-80">
            <div class="card-header color-dark fw-500">
                <h4>{{ __('Edit Translation') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('languages.updateTranslations', $language->id) }}" method="POST"
                          class="col-11 m-auto ">
                        @csrf
                        <div class="form-group" id="translations">
                            @foreach($translations as $key => $translation)
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}"
                                               value="{{ $key }}" disabled>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" id="{{ $key }}"
                                               name="translations[{{ $key }}]"
                                               value="{{ $translation }}">
                                    </div>
                                </div>
                            @endforeach

                            <x-error-message name="name"/>
                        </div>
                        <div class="row mt-20 gap-20">
                            <button onclick="addNewTranslation()" type="button"
                                    class="btn btn-primary">{{ __('Add New Translation') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Update Translation') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <script>
            function addNewTranslation() {
                // add new translation
                let translations = document.getElementById('translations');
                let row = document.createElement('div');
                row.classList.add('row');
                let col1 = document.createElement('div');
                col1.classList.add('col-6');
                let col2 = document.createElement('div');
                col2.classList.add('col-6');
                let input1 = document.createElement('input');
                input1.classList.add('form-control');
                input1.setAttribute('type', 'text');
                input1.setAttribute('name', 'keys[]');
                input1.setAttribute('placeholder', '{{ __('Key') }}');
                let input2 = document.createElement('input');
                input2.classList.add('form-control');
                input2.setAttribute('type', 'text');
                input2.setAttribute('name', 'values[]');
                input2.setAttribute('placeholder', '{{ __('Translation') }}');
                col1.appendChild(input1);
                col2.appendChild(input2);
                row.appendChild(col1);
                row.appendChild(col2);
                translations.appendChild(row);
            }
        </script>
@endsection
