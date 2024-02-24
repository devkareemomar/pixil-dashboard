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
        Schema::create('album_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->index();
            $table->foreignId('language_id')->index();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_languages');
    }
};
