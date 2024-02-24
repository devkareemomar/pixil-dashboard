<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'application_name' => ['nullable', 'string'],
            'application_logo_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'mobile_logo_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'dark_application_logo_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'custom_css_file' => ['nullable', 'mimes:css', 'max:2048'],
            'allow_self_registration' => ['nullable', 'boolean'],
            'is_new_registered_user_active_by_default' => ['nullable', 'boolean'],
            'use_captcha_on_registration' => ['nullable', 'boolean'],
            'use_captcha_on_login' => ['nullable', 'boolean'],
            'is_session_time_out_enabled' => ['nullable', 'boolean'],
            'time_out_second' => ['nullable', 'integer'],
            'show_time_out_notification_second' => ['nullable', 'integer'],
            'is_email_confirmation_required_for_login' => ['nullable', 'boolean'],
            'is_cookie_consent_enabled' => ['nullable', 'boolean'],
            'use_default_settings' => ['nullable', 'boolean'],
            'require_digit' => ['nullable', 'boolean'],
            'require_lowercase' => ['nullable', 'boolean'],
            'require_non_alphanumeric' => ['nullable', 'boolean'],
            'require_uppercase' => ['nullable', 'boolean'],
            'required_length' => ['nullable', 'integer'],
            'is_enabled' => ['nullable', 'boolean'],
            'max_failed_access_attempts_before_lockout' => ['nullable', 'integer'],
            'default_account_lockout_seconds' => ['nullable', 'integer'],
            'is_email_provider_enabled' => ['nullable', 'boolean'],
            'is_sms_provider_enabled' => ['nullable', 'boolean'],
            'is_google_authenticator_enabled' => ['nullable', 'boolean'],
            'is_remember_browser_enabled' => ['nullable', 'boolean'],
            'default_from_address' => ['nullable', 'string'],
            'default_from_display_name' => ['nullable', 'string'],
            'smtp_host' => ['nullable', 'string'],
            'smtp_port' => ['nullable', 'integer'],
            'smtp_enable_ssl' => ['nullable', 'boolean'],
            'smtp_use_default_credentials' => ['nullable', 'boolean'],
            'smtp_domain' => ['nullable', 'string'],
            'smtp_user_name' => ['nullable', 'string'],
            'smtp_password' => ['nullable', 'string'],
            'test_email_address_input' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string'],
            'whatsapp' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'youtube' => ['nullable', 'string'],
            'tiktok' => ['nullable', 'string'],
            'is_quick_theme_select_enabled' => ['nullable', 'boolean'],
            'color_scheme' => ['nullable', 'string'],
            'primary_color' => ['nullable', 'string'],
            'secondary_color' => ['nullable', 'string'],
            'shadow_transparency' => ['nullable', 'integer'],
            'primary_button' => ['nullable', 'string'],
            'secondary_button' => ['nullable', 'string'],
            'footer_background_color' => ['nullable', 'string'],
            'font' => ['nullable', 'string'],
            'header_color' => ['nullable', 'string'],
            'header_size' => ['nullable', 'integer'],
            'breadcrumb' => ['nullable', 'boolean'],
            'meta_tags_head' => ['nullable', 'string'],
            'meta_tags_body' => ['nullable', 'string'],
            'meta_tags_footer' => ['nullable', 'string'],
        ];
    }

}
