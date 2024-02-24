@php
    $projectStatuses = \App\Models\ProjectStatus::all();
    $categories = \App\Models\Category::all();
    $countries = \App\Models\Country::all();
@endphp
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#quickAdd">
    {{ __('Quick Add') }}
</button>

<!-- Modal -->
<div class="modal fade" id="quickAdd" tabindex="-1" aria-labelledby="quickAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data"
                  x-data="{ slug: '{{ old('slug') }}' }" id="quickAddForm">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="quickAddLabel">{{ __('Quick Add') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @include('projects.partials.tabs.1')
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                   value="{{ old('start_date', date('Y-m-d')) }}" onfocus="this.showPicker()">
                            <x-error-message name="start_date"/>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                   value="{{ old('end_date', date('Y-m-d', strtotime('+1 month'))) }}"
                                   onfocus="this.showPicker()">
                            <x-error-message name="end_date"/>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="suggested_values" class="form-label">{{ __('Suggested values') }}</label>
                            <input type="text" name="suggested_values" class="suggested_values form-control"
                                   value="{{ old('suggested_values') }}">
                            <x-error-message name="suggested_values"/>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="category_id" class="form-label">{{ __('Category') }}</label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">{{ __('Select Category') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' :
									'' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error-message name="category_id"/>
                        </div>
                        <div class="mb-3 col-3">
                            <label for="country_id" class="form-label">{{ __('Country') }}</label>
                            <select class="form-control" id="country_id" name="country_id">
                                <option value="">{{ __('Select Country') }}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected(old('country_id')==$country->id)>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-3">
                            <label for="total_wanted" class="form-label">{{ __('Total Wanted') }}</label>
                            <input type="number" class="form-control" id="total_wanted" name="total_wanted"
                                   value="{{ old('total_wanted',0) }}" min="1"
                                   oninput="validity.valid||(value='');" required>
                            <x-error-message name="total_wanted"/>
                        </div>
                        <div class="mb-3 col-3">
                            <label for="project_status_id" class="form-label">{{ __('Status') }}</label>
                            <select class="form-control" id="project_status_id" name="project_status_id" >
                                <option value="" hidden>{{__('Select Status')}}</option>
                                @foreach ($projectStatuses as $projectStatus)
                                    <option value="{{ $projectStatus->id }}"
                                        @selected(old('project_status_id')==$projectStatus->id)>{{ $projectStatus->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-error-message name="project_status_id"/>
                        </div>
                        <div class="mb-3 col-3">
                            <x-toggle-switch name="active" label="{{ __('Active') }}"/>
                            <x-error-message name="active" />
                        </div>
                        <div class="mb-3 col-3">
                            <x-toggle-switch name="is_continuous" label="{{__('Is Continuous')}}"/>
                            <x-error-message name="is_continuous"/>
                        </div>
                        <div class="mb-3 col-3">
                            <x-toggle-switch name="show_in_home_page" label="{{__('Show in Home Page')}}"/>
                            <x-error-message name="show_in_home_page"/>
                        </div>
                        <div class="mb-3 col-3">
                            <x-toggle-switch name="show_timer" label="{{ __('Show Timer') }}"/>
                            <x-error-message name="show_timer"/>
                        </div>
                        <div class="mb-3 col-3">
                            <x-toggle-switch name="show_target_amount" label="{{ __('Show Target Amount') }}"/>
                            <x-error-message name="show_target_amount"/>
                        </div>
                        <div class="mb-3 col-3">
                            <x-toggle-switch name="show_paid_amount" label="{{ __('Show Paid Amount') }}"/>
                            <x-error-message name="show_paid_amount"/>
                        </div>
                        <div class="mb-3 col-3">
                            <x-toggle-switch name="show_percentage" label="{{ __('Show Percentage') }}"/>
                            <x-error-message name="show_percentage"/>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="main_image" class="form-label">{{ __('Main Image') }}</label>
                            <input type="file" class="form-control filepond" id="main_image" name="main_image">
                            <small class="text-muted">{{ __('Size') }}: (452 px * 348 px)</small>
                            <x-error-message name="main_image"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" type="button" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
