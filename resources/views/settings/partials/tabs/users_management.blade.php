<div class="container card-body row">
	<div class="form-group col-6">
		<x-toggle-switch name="allow_self_registration" label="{{ __('Allow Self Registration') }}"
			value="{{ $setting->allow_self_registration }}" />
		<x-error-message name="allow_self_registration" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="is_new_registered_user_active_by_default"
			label="{{ __('Is New Registered User Active by Default') }}"
			value="{{ $setting->is_new_registered_user_active_by_default }}" />
		<x-error-message name="is_new_registered_user_active_by_default" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="use_captcha_on_registration" label="{{ __('Use Captcha on Registration') }}"
			value="{{ $setting->use_captcha_on_registration }}" />
		<x-error-message name="use_captcha_on_registration" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="use_captcha_on_login" label="{{ __('Use Captcha on Login') }}"
			value="{{ $setting->use_captcha_on_login }}" />
		<x-error-message name="use_captcha_on_login" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="is_session_time_out_enabled" label="{{ __('Is Session Time-out Enabled') }}"
			value="{{ $setting->is_session_time_out_enabled }}" />
		<x-error-message name="is_session_time_out_enabled" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="is_email_confirmation_required_for_login"
			label="{{ __('Is Email Confirmation Required for Login') }}"
			value="{{ $setting->is_email_confirmation_required_for_login }}" />
		<x-error-message name="is_email_confirmation_required_for_login" />
	</div>
	<div class="form-group col-6">
		<x-toggle-switch name="is_cookie_consent_enabled" label="{{ __('Is Cookie Consent Enabled') }}"
			value="{{ $setting->is_cookie_consent_enabled }}" />
		<x-error-message name="is_cookie_consent_enabled" />
	</div>
	<div class="form-group col-6">
		<label for="time_out_second">{{ __('Time Out (Seconds)') }}</label>
		<input type="number" class="form-control @error('time_out_second') is-invalid @enderror" id="time_out_second"
			name="time_out_second" value="{{ old('time_out_second',$setting->time_out_second ?? 300) }}">
		<x-error-message name="time_out_second" />
	</div>
	<div class="form-group col-6">
		<label for="show_time_out_notification_second">{{ __('Show Time Out Notification (Seconds)') }}</label>
		<input type="number" class="form-control @error('show_time_out_notification_second') is-invalid @enderror"
			id="show_time_out_notification_second" name="show_time_out_notification_second"
			value="{{ old('show_time_out_notification_second',$setting->show_time_out_notification_second ?? 30) }}">
		<x-error-message name="show_time_out_notification_second" />
	</div>
</div>