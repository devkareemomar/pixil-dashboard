<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('featured')->default(false)->change();
            $table->boolean('accept_donation')->default(false)->change();
            $table->boolean('show_in_home_page')->default(false)->change();
            $table->boolean('show_in_shop')->default(false)->change();
            $table->boolean('is_gift')->default(false)->change();
            $table->boolean('active')->default(false)->change();
            $table->boolean('show_in_menu')->default(false)->change();
            $table->boolean('hidden')->default(false)->change();
            $table->boolean('donation_available')->default(false)->change();
            $table->boolean('show_donation_comment')->default(false)->change();
            $table->boolean('is_zakat')->default(false)->change();
            $table->boolean('show_donor_phone')->default(false)->change();
            $table->boolean('donor_phone_required')->default(false)->change();
            $table->boolean('show_donor_name')->default(false)->change();
            $table->boolean('donor_name_required')->default(false)->change();
            $table->boolean('show_banner')->default(false)->change();
            $table->boolean('is_continuous')->default(false)->change();
            $table->boolean('is_full_unit')->default(false)->change();
            $table->boolean('is_multi_country')->default(false)->change();
            $table->boolean('is_stock')->default(false)->change();
            $table->boolean('is_quick_donation')->default(false)->change();
            $table->boolean('show_timer')->default(false)->change();
            $table->boolean('show_target_amount')->default(false)->change();
            $table->boolean('show_paid_amount')->default(false)->change();
            $table->boolean('show_percentage')->default(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
