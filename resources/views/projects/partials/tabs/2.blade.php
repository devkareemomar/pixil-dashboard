<div class="mb-3 col-4">
    <x-toggle-switch name="active" label="{{ __('Active') }}" :value="$project?->active" />
    <x-error-message name="active" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="show_in_menu" label="{{ __('Show in Menu') }}" :value="$project?->show_in_menu" />
    <x-error-message name="show_in_menu" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="hidden" label="{{ __('Hidden') }}" :value="$project?->hidden" />
    <x-error-message name="hidden" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="donation_available" label="{{ __('Donation Available') }}" :value="$project?->donation_available" />
    <x-error-message name="donation_available" />
</div>
{{-- <div class="mb-3 col-4"> --}}
{{--    <x-toggle-switch name="is_zakat" label="{{__('Is Zakat')}}" :value="$project?->is_zakat"/> --}}
{{--    <x-error-message name="is_zakat"/> --}}
{{-- </div> --}}
<div class="mb-3 col-4">
    <x-toggle-switch x-on:click="show_donor_phone = !show_donor_phone" name="show_donor_phone"
        label="{{ __('Show Donor Phone') }}" :value="$project?->show_donor_phone" />
    <x-error-message name="show_donor_phone" />
</div>
<div class="mb-3 col-4" x-show="show_donor_phone">
    <x-toggle-switch name="donor_phone_required" label="{{ __('Donor Phone Required') }}" :value="$project?->donor_phone_required" />
    <x-error-message name="donor_phone_required" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch x-on:click="show_donor_name = !show_donor_name" name="show_donor_name"
        label="{{ __('Show Donor Name') }}" :value="$project?->show_donor_name" />
    <x-error-message name="show_donor_name" />
</div>
<div class="mb-3 col-4" x-show="show_donor_name">
    <x-toggle-switch name="donor_name_required" label="{{ __('Donor Name Required') }}" :value="$project?->donor_name_required" />
    <x-error-message name="donor_name_required" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="is_continuous" label="{{ __('Is Continuous') }}" :value="$project?->is_continuous" />
    <x-error-message name="is_continuous" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="is_full_unit" id="is_full_unit" label="{{ __('Is Full Unit') }}" :value="$project?->is_full_unit" />
    <x-error-message name="is_full_unit" />
</div>

{{-- <div class="mb-3 col-4"> --}}
{{--    <x-toggle-switch name="is_quick_donation" label="{{__('Is Quick Donation')}}" --}}
{{--                     :value="$project?->is_quick_donation"/> --}}
{{--    <x-error-message name="is_quick_donation"/> --}}
{{-- </div> --}}
{{-- <div class="mb-3 col-4">
    <x-toggle-switch name="accept_donation" label="{{__('Accept Donation')}}" :value="$project?->accept_donation"/>
    <x-error-message name="accept_donation"/>
</div> --}}
<div class="mb-3 col-4">
    <x-toggle-switch name="show_in_home_page" label="{{ __('Show in Home Page') }}" :value="$project?->show_in_home_page" />
    <x-error-message name="show_in_home_page" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="show_in_shop" label="{{ __('Show in Shop') }}" :value="$project?->show_in_shop" />
    <x-error-message name="show_in_shop" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="is_gift" label="{{ __('Is Gift') }}" :value="$project?->is_gift" />
    <x-error-message name="is_gift" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="is_project_case" label="{{ __('Is Project Case') }}" :value="$project?->is_project_case" />
    <x-error-message name="is_project_case" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="show_timer" label="{{ __('Show Timer') }}" :value="$project?->show_timer" />
    <x-error-message name="show_timer" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="show_target_amount" label="{{ __('Show Target Amount') }}" :value="$project?->show_target_amount" />
    <x-error-message name="show_target_amount" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="show_paid_amount" label="{{ __('Show Paid Amount') }}" :value="$project?->show_paid_amount" />
    <x-error-message name="show_paid_amount" />
</div>
<div class="mb-3 col-4">
    <x-toggle-switch name="show_percentage" label="{{ __('Show Percentage') }}" :value="$project?->show_percentage" />
    <x-error-message name="show_percentage" />
</div>

{{-- <div class="mb-3 col-4"> --}}
{{--    <x-toggle-switch name="featured" label="{{ __('Featured') }}" :value="$project?->featured"/> --}}
{{--    <x-error-message name="featured"/> --}}
{{-- </div> --}}

<div class="mb-3 col-4">
    <x-toggle-switch x-on:click="showDonationComment = !showDonationComment" name="show_donation_comment"
        label="{{ __('Show Donation Comment') }}" :value="$project?->show_donation_comment" />
    <x-error-message name="show_donation_comment" />
</div>
<template x-if="showDonationComment">
    <div class="mb-3 col-4">
        <label for="donation_comment" class="form-label">{{ __('Donation Comment') }}</label>
        <input type="text" class="form-control" id="donation_comment" name="donation_comment"
            value="{{ old('donation_comment', $project?->donation_comment) }}">
        <x-error-message name="donation_comment" />
    </div>
</template>
<hr class="my-4">
<div class="col-12 row">
    <div class="mb-3 col-4">
        <label for="sku" class="form-label">{{ __('SKU') }}</label>
        <input type="text" class="form-control" id="sku" name="sku"
            value="{{ old('sku', $project?->sku) }}">
        <x-error-message name="sku" />
    </div>
    <div class="mb-3 col-4">
        <label for="project_status_id" class="form-label">{{ __('Status') }}</label>
        <select class="form-control" id="project_status_id" name="project_status_id">
            <option value="" hidden>{{ __('Select Status') }}</option>
            @foreach ($projectStatuses as $projectStatus)
                <option value="{{ $projectStatus->id }}" @selected(old('project_status_id', $project?->project_status_id) == $projectStatus->id)>{{ $projectStatus->name }}
                </option>
            @endforeach
        </select>
        <x-error-message name="project_status_id" />
    </div>

    <div class="mb-3 col-4">
        <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
        <input type="date" class="form-control" id="start_date" name="start_date"
            value="{{ old('start_date', $project?->start_date ? date('Y-m-d', strtotime($project?->start_date)) : date('Y-m-d')) }}"
            onfocus="this.showPicker()">
        <x-error-message name="start_date" />
    </div>
    <div class="mb-3 col-4">
        <label for="end_date" class="form-label">{{ __('End Date') }}</label>
        <input type="date" class="form-control" id="end_date" name="end_date"
            value="{{ old('end_date', $project?->end_date ? date('Y-m-d', strtotime($project?->end_date)) : date('Y-m-d', strtotime('+1 month'))) }}"
            onfocus="this.showPicker()">
        <x-error-message name="end_date" />
    </div>

    <div class="mb-3 col-4">
        <label for="visibility" class="form-label">{{ __('Visibility') }} <span class="text-danger">*</span></label>
        <select class="form-control" id="visibility" name="visibility" required>
            @foreach (App\Enums\ProjectVisibility::cases() as $visibility)
                <option value="{{ $visibility }}" @selected(old('visibility', $project?->visibility) == $visibility->name)>
                    {{ $visibility->name }}
                </option>
            @endforeach
        </select>
        <x-error-message name="visibility" />
    </div>
    <div class="mb-3 col-4">
        <label for="category_id" class="form-label">{{ __('Category') }}</label>
        <select class="form-control" id="category_id" name="category_id">
            <option value="">{{ __('Select Category') }}</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $project?->category_id) == $category->id ? 'selected' : '')>{{ $category->name }}</option>
            @endforeach
        </select>
        <x-error-message name="category_id" />
    </div>
    <div class="mb-3 col-4">
        <label for="sub_category_id" class="form-label">{{ __('Sub Category') }}</label>
        <select class="form-control" id="sub_category_id" name="sub_category_id">
            <option value="">{{ __('Select Category') }}</option>
            @foreach ($subCategories as $category)
                <option value="{{ $category->id }}" @selected(old('sub_category_id', $project?->sub_category_id) == $category->id ? 'selected' : '')>{{ $category->name }}</option>
            @endforeach
        </select>
        <x-error-message name="sub_category_id" />
    </div>
    <div class="mb-3 col-4">
        <label for="unit_value" class="form-label">{{ __('Unit Value') }}</label>
        <input type="number" class="form-control" id="unit_value" name="unit_value"
            value="{{ old('unit_value', $project?->unit_value) }}">
        <x-error-message name="unit_value" />
    </div>
    <div class="mb-3 col-4">
        <label for="video" class="form-label">{{ __('Video') }}</label>
        <input type="text" class="form-control" id="video" name="video"
            value="{{ old('video', $project?->video) }}">
        <x-error-message name="video" />
    </div>
</div>
<script>
    $("#add").click(function() {
        $("#div_add").append(
            '<div id="new_div"> <input id="add-input" class="form-control"  style="display: inline-block;width: 50%" type="text" name="videos[]">' +
            '<input type="button"  class="btn btn-danger m-1" id="remove" style="display: inline-block" value="-"></div>'
        );
    });


    $("body").on("click", "#is_full_unit", function() {
        const isChecked = $(this).is(":checked");
        $('#suggested_label').toggle(isChecked);
        $('input[name="suggested_label"]').val('');

    });
    $(document).ready(function() {
        const isChecked = $('#is_full_unit').is(":checked");
        $('#suggested_label').toggle(isChecked);
    });


    $("body").on("click", "#remove", function() {
        $(this).parents("#new_div").remove();
    })
</script>
