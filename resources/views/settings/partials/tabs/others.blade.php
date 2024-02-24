<div class="container card-body row">
    <div class="form-group col-6">
        <x-toggle-switch
            name="is_quick_theme_select_enabled"
            label="{{ __('Is Quick Theme Select Enabled') }}"
            value="{{ $setting->is_quick_theme_select_enabled }}"
        />
        <x-error-message name="is_quick_theme_select_enabled"/>
    </div>
</div>
