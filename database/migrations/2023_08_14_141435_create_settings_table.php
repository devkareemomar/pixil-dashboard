<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('application_logo_image')->nullable();
            $table->string('custom_css_file')->nullable();
            $table->boolean('allow_self_registration')->default(true);
            $table->boolean('is_new_registered_user_active_by_default')->default(true);
            $table->boolean('use_captcha_on_registration')->default(false);
            $table->boolean('use_captcha_on_login')->default(false);
            $table->boolean('is_session_time_out_enabled')->default(false);
            $table->integer('time_out_second')->default(300);
            $table->integer('show_time_out_notification_second')->default(30);
            $table->boolean('is_email_confirmation_required_for_login')->default(false);
            $table->boolean('is_cookie_consent_enabled')->default(true);
            $table->boolean('use_default_settings')->default(true);
            $table->boolean('require_digit')->default(false);
            $table->boolean('require_lowercase')->default(false);
            $table->boolean('require_non_alphanumeric')->default(false);
            $table->boolean('require_uppercase')->default(false);
            $table->integer('required_length')->default(3);
            $table->boolean('is_enabled')->default(false);
            $table->integer('max_failed_access_attempts_before_lockout')->default(5);
            $table->integer('default_account_lockout_seconds')->default(300);
            $table->boolean('is_email_provider_enabled')->default(true);
            $table->boolean('is_sms_provider_enabled')->default(true);
            $table->boolean('is_google_authenticator_enabled')->default(false);
            $table->boolean('is_remember_browser_enabled')->default(true);
            $table->string('default_from_address')->nullable();
            $table->string('default_from_display_name')->nullable();
            $table->string('smtp_host')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->boolean('smtp_enable_ssl')->default(true);
            $table->boolean('smtp_use_default_credentials')->default(false);
            $table->string('smtp_domain')->nullable();
            $table->string('smtp_user_name')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('test_email_address_input')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();
            $table->boolean('is_quick_theme_select_enabled')->default(false);
            $table->string('color_scheme', 10)->nullable();
            $table->boolean('is_expired')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
