<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('country_project', function (Blueprint $table) {
            $table->string('suggested_values')->nullable();
            $table->dropColumn('share_value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('country_project', function (Blueprint $table) {
            $table->dropColumn('suggested_values');
            $table->string('share_value')->nullable();
        });
    }
};
