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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->integer('shadow_transparency')->nullable();
            $table->string('primary_button')->nullable();
            $table->string('secondary_button')->nullable();
            $table->string('footer_background_color')->nullable();
            $table->string('font')->nullable();
            $table->string('header_color')->nullable();
            $table->integer('header_size')->nullable();
            $table->boolean('breadcrumb')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
};
