<div class="container card-body row">
	<div class="form-group col-6">
		<x-toggle-switch name="use_default_settings" label="{{ __('Use Default Settings') }}"
			value="{{ $setting->use_default_settings }}" onchange="valueChanged()" />
		<x-error-message name="is_cookie_consent_enabled" />
		<x-error-message name="use_default_settings" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="require_digit" label="{{ __('Require Digit') }}" value="{{ $setting->require_digit }}" />
		<x-error-message name="require_digit" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="require_lowercase" label="{{ __('Require Lowercase') }}"
			value="{{ $setting->require_lowercase }}" />
		<x-error-message name="require_lowercase" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="require_non_alphanumeric" label="{{ __('Require Non-Alphanumeric') }}"
			value="{{ $setting->require_non_alphanumeric }}" />
		<x-error-message name="require_non_alphanumeric" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="require_uppercase" label="{{ __('Require Uppercase') }}"
			value="{{ $setting->require_uppercase }}" />
		<x-error-message name="require_uppercase" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="is_enabled" label="{{ __('Is Enabled') }}" value="{{ $setting->is_enabled }}" />
		<x-error-message name="is_enabled" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="is_email_provider_enabled" label="{{ __('Is Email Provider Enabled') }}"
			value="{{ $setting->is_email_provider_enabled }}" />
		<x-error-message name="is_email_provider_enabled" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="is_sms_provider_enabled" label="{{ __('Is SMS Provider Enabled') }}"
			value="{{ $setting->is_sms_provider_enabled }}" />
		<x-error-message name="is_sms_provider_enabled" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="is_google_authenticator_enabled" label="{{ __('Is Google Authenticator Enabled') }}"
			value="{{ $setting->is_google_authenticator_enabled }}" />
		<x-error-message name="is_google_authenticator_enabled" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="is_remember_browser_enabled" label="{{ __('Is Remember Browser Enabled') }}"
			value="{{ $setting->is_remember_browser_enabled }}" />
		<x-error-message name="is_remember_browser_enabled" />
	</div>
	<div class="form-group col-6">
		<label for="required_length">{{ __('Required Length') }}</label>
		<input type="number" class="form-control @error('required_length') is-invalid @enderror" id="required_length"
			name="required_length" value="{{ old('required_length', $setting->required_length) }}">
		<x-error-message name="required_length" />
	</div>
	<div class="form-group col-6">
		<label for="max_failed_access_attempts_before_lockout">{{ __('Max Failed Access Attempts Before Lockout')
			}}</label>
		<input type="number"
			class="form-control @error('max_failed_access_attempts_before_lockout') is-invalid @enderror"
			id="max_failed_access_attempts_before_lockout" name="max_failed_access_attempts_before_lockout"
			value="{{ old('max_failed_access_attempts_before_lockout',$setting->max_failed_access_attempts_before_lockout, 5) }}">
		<x-error-message name="max_failed_access_attempts_before_lockout" />
	</div>
	<div class="form-group col-6">
		<label for="default_account_lockout_seconds">{{ __('Default Account Lockout Seconds') }}</label>
		<input type="number" class="form-control @error('default_account_lockout_seconds') is-invalid @enderror"
			id="default_account_lockout_seconds" name="default_account_lockout_seconds"
			value="{{ old('default_account_lockout_seconds',$setting->default_account_lockout_seconds, 300) }}">
		<x-error-message name="default_account_lockout_seconds" />
	</div>
</div>

<script>
	function valueChanged() {
		if ($('#use_default_settings').prop("checked")) {
			$("#require_digit").attr("disabled", true).prop("checked", false);
			$("#require_lowercase").attr("disabled", true).prop("checked", false);
			$("#require_non_alphanumeric").attr("disabled", true).prop("checked", false);
			$("#require_uppercase").attr("disabled", true).prop("checked", false);
			$("#required_length").attr("disabled", true).val(3);

		} else {
			$("#require_digit").removeAttr("disabled");
			$("#require_lowercase").removeAttr("disabled");
			$("#require_lowercase").removeAttr("disabled");
			$("#require_non_alphanumeric").removeAttr("disabled");
			$("#require_uppercase").removeAttr("disabled");
			$("#required_length").removeAttr("disabled");
		}
	}
	$(document).ready(function() {
		valueChanged();
	});
</script>