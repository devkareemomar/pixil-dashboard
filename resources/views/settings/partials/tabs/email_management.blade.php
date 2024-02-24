<div class="container card-body row">
    <div class="form-group col-6">
        <label for="default_from_address">{{ __('Default From Address') }}</label>
        <input type="email"
               class="form-control @error('default_from_address') is-invalid @enderror"
               id="default_from_address" name="default_from_address"
               value="{{ old('default_from_address',$setting->default_from_address) }}">
        <x-error-message name="default_from_address"/>
    </div>
    <div class="form-group col-6">
        <label for="default_from_display_name">{{ __('Default From Display Name') }}</label>
        <input type="text"
               class="form-control @error('default_from_display_name') is-invalid @enderror"
               id="default_from_display_name" name="default_from_display_name"
               value="{{ old('default_from_display_name',$setting->default_from_display_name) }}">
        <x-error-message name="default_from_display_name"/>
    </div>
    <div class="form-group col-6">
        <label for="smtp_host">{{ __('SMTP Host') }}</label>
        <input type="text" class="form-control @error('smtp_host') is-invalid @enderror"
               id="smtp_host" name="smtp_host"
               value="{{ old('smtp_host',$setting->smtp_host) }}">
        <x-error-message name="smtp_host"/>
    </div>
    <div class="form-group col-6">
        <label for="smtp_port">{{ __('SMTP Port') }}</label>
        <input type="number" class="form-control @error('smtp_port') is-invalid @enderror"
               id="smtp_port" name="smtp_port"
               value="{{ old('smtp_port',$setting->smtp_port) }}">
        <x-error-message name="smtp_port"/>
    </div>
    <div class="form-group col-6">
        <x-toggle-switch
            name="smtp_enable_ssl"
            label="{{ __('SMTP Enable SSL') }}"
            value="{{ $setting->smtp_enable_ssl }}"
        />
        <x-error-message name="smtp_enable_ssl"/>
    </div>
    <div class="form-group col-6">
        <x-toggle-switch
            name="smtp_use_default_credentials"
            label="{{ __('SMTP Use Default Credentials') }}"
            value="{{ $setting->smtp_use_default_credentials }}"
        />
        <x-error-message name="smtp_use_default_credentials"/>
    </div>
    <div class="form-group col-6">
        <label for="smtp_domain">{{ __('SMTP Domain') }}</label>
        <input type="text" class="form-control @error('smtp_domain') is-invalid @enderror"
               id="smtp_domain" name="smtp_domain"
               value="{{ old('smtp_domain',$setting->smtp_domain) }}">
        <x-error-message name="smtp_domain"/>
    </div>
    <div class="form-group col-6">
        <label for="smtp_user_name">{{ __('SMTP User Name') }}</label>
        <input type="text" class="form-control @error('smtp_user_name') is-invalid @enderror"
               id="smtp_user_name" name="smtp_user_name"
               value="{{ old('smtp_user_name',$setting->smtp_user_name) }}">
        <x-error-message name="smtp_user_name"/>
    </div>
    <div class="form-group col-6">
        <label for="smtp_password">{{ __('SMTP Password') }}</label>
        <input type="password" class="form-control @error('smtp_password') is-invalid @enderror"
               id="smtp_password" name="smtp_password"
               value="{{ old('smtp_password',$setting->smtp_password) }}">
        <x-error-message name="smtp_password"/>
    </div>
    <div class="form-group col-6">
        <label for="test_email_address_input">{{ __('Test Email Address') }}</label>
        <input type="email"
               class="form-control @error('test_email_address_input') is-invalid @enderror"
               id="test_email_address_input" name="test_email_address_input"
               value="{{ old('test_email_address_input',$setting->test_email_address_input) }}">
        <x-error-message name="test_email_address_input"/>
    </div>
</div>
