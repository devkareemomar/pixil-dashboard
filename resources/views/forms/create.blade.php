@extends('layout.app')

@section('title', __('Projects'))
@section('description', __('Manage Form Builder'))

@section('content')
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .formbuilder-icon-button, .formbuilder-icon-header, .formbuilder-icon-autocomplete,
        .formbuilder-icon-hidden, .formbuilder-icon-paragraph,
        .form-wrap.form-builder.formbuilder-embedded-bootstrap .btn-group, .formbuilder-icon-select ,.access-wrap, .value-wrap {
            display: none !important;
        }

        .formbuilder-icon-checkbox-group:before, .formbuilder-icon-select:before,
        .formbuilder-icon-radio-group:before, .formbuilder-icon-number:before,
        .formbuilder-icon-file:before, .formbuilder-icon-date:before,
        .formbuilder-icon-textarea:before, .formbuilder-icon-text:before {
            color: #A0A0A0;
            padding: 5px 5% 5px 0;
        }

        .form-wrap.form-builder .frmb .prev-holder input[type=number] {
            width: 100%;
        }

        .form-wrap.form-builder .formbuilder-checkbox-group input[type=checkbox], .form-wrap.form-builder .formbuilder-checkbox-group input[type=radio], .form-wrap.form-builder .formbuilder-radio-group input[type=checkbox], .form-wrap.form-builder .formbuilder-radio-group input[type=radio] {
            margin: 0 4px 0 10px;
        }
        
        .form-wrap.form-builder .cb-wrap.pull-left, .form-wrap.form-builder .stage-wrap.pull-left {
            float: right;
            min-height: 340px !important;
        }

        .field-label {
            color: black !important;
        }

        .form-wrap.form-builder .frmb li.form-field {
            border: #E3E6EF 1px solid !important;
            border-radius: 6px;
            padding: 10px;
        }

        @if(app()->getLocale() == "ar")
         .ui-sortable li {
            text-align: right !important;
        }

        .form-wrap.form-builder .cb-wrap.pull-left, .form-wrap.form-builder .stage-wrap.pull-left {
            float: left;
        }

        .form-wrap.form-builder .frmb .form-elements .false-label:first-child, .form-wrap.form-builder .frmb .form-elements label:first-child {
            float: right;
        }

        .formbuilder-icon-checkbox-group:before, .formbuilder-icon-select:before,
        .formbuilder-icon-radio-group:before, .formbuilder-icon-number:before,
        .formbuilder-icon-file:before, .formbuilder-icon-date:before,
        .formbuilder-icon-textarea:before, .formbuilder-icon-text:before {
            padding: 5px 0 5px 7%;
        }


        @endif
    </style>
    <div class="container-fluid">
        <Br>
        <div class="card mb-80" style="padding-bottom: 20px">
            <div class="card-header color-dark fw-500">
                <h4 class="text-capitalize">{{ __('Projects') }}</h4>
            </div>
            <div class="card-body" style="padding: 2%">
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0">
                            <div class="p-0">
                                <div class="tab-content" id="tabcontent2">
                                        

                                                <div class="col-12 col-lg-4 col-md-3">
                                                    <label>{{ __('Status Name') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="status_name"
                                                           name="status_name"
                                                           class="form-control"
                                                           value="{{ old('status_name') }}">

                                        </div>
                                    <div class="col-12 col-lg-4 col-md-3">
                                        <br>
                                        <label> {{ __('Project Name') }}<span class="text-danger">*</span></label>
                                        <select required style="font-size: 20px" class="js-example-basic-multiple"
                                                name="project_id" id="project_id">
                                            <option disabled>{{ __('Select Project') }}</option>
                                        @foreach(\App\Models\Project::where('is_project_case',1)->get() as $project)
                                                <option value="{{$project->id}}">{{ $project->name }}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-lg-4 col-md-3">
                                        <br>
                                        <label> {{ __('Language') }}<span class="text-danger">*</span></label>
                                        <select required style="font-size: 20px" class="js-example-basic-multiple"
                                                name="locale" id="locale">
                                            <option disabled>{{ __('Select language') }}</option>
                                        @foreach($languages as $language)
                                                <option value="{{$language->short_name}}">{{ $language->name }}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div id="build-wrap" class="col-12 mt-50"></div>
                                    <div class="col-6 mt-20">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" value="1"
                                                   name="is_active" id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label"
                                                   for="flexSwitchCheckChecked">{{ __('Is Active') }}</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="setDataWrap">
                                        <input id="save-all" class="btn btn-primary" type="button"
                                               value="{{__('Create')}}">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        jQuery(function ($) {
            var options = {
                controlOrder: [
                    'text',
                    'number',
                    'date',
                    'textarea'
                ]
            };

            @if(app()->getLocale() == "ar")
                options.i18n = {
                location: '{{asset("lang/")}}',
                locale: 'ar'
            };
            @endif

            var fbEditor = document.getElementById('build-wrap');
            var formBuilder = $(fbEditor).formBuilder(options);
            document.getElementById('save-all').addEventListener('click', function () {
                event.preventDefault();
                var checkbox = document.querySelector('#flexSwitchCheckChecked');
                var project_id = document.getElementById('project_id').value;
                var locale = document.getElementById('locale').value;
                var isChecked = checkbox.checked;
                var active = isChecked ? 1 : 0;
                var status_name = document.getElementById('status_name').value;
                var formFields = document.querySelectorAll('[name^="status_name"]');
                var data = {};
                var hasEmptyFields = false;

                formFields.forEach(function (field) {
                    var fieldValue = field.value;
                    var fieldName = field.name;
                    /* var languageId = fieldName.match(/\[(\d+)\]/)[1]; */
                    var fieldKey = fieldName.split('[')[0];
                    if (!fieldValue) {
                        hasEmptyFields = true;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                    /* if (!data[languageId]) {
                        data[languageId] = {};
                    }
                    data[languageId][fieldKey] = fieldValue; */
                });
                if (hasEmptyFields) {
                    $(document).ready(function () {
                        Swal.fire({
                            type: 'error',
                            title: '{{__('Oops...')}}',
                            text: '{{__('Please fill out all language fields.')}}'
                        })
                    });
                    return;
                }
                var form_data = formBuilder.actions.getData('json')
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    method: 'POST',
                    url: '{{ route("forms.store") }}',
                    dataType: 'json',
                    data: {
                        _token: csrfToken,
                        form_data: form_data,
                        data: data,
                        active: active,
                        project_id:project_id,
                        locale: locale,
                        status_name: status_name
                    },
                    success: function (response) {
                        $(document).ready(function () {
                            Swal.fire({
                                type: 'success',
                                title: response,
                                showConfirmButton: false,
                                timer: 3000
                            })
                        });
                        setTimeout(function() {
                            window.location.href = '{{route("forms.index")}}';
                        }, 3000);

                    },
                    error: function (xhr, status, error) {
                        $(document).ready(function () {
                            Swal.fire({
                                type: 'error',
                                title: '{{__('Oops...')}}',
                                text: error
                            })
                        });
                    }
                });
            });

        });
    </script>
@endsection



