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
        Schema::create('form_builder_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_builder_id')->index();
            $table->integer('price')->nullable();
            $table->date('checks_date')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('national_id');
            $table->json('data');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_builder_data');
    }
};
