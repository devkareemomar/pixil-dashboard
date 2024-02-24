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
        Schema::create('cart_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id');
            $table->foreignId('project_id');
            $table->decimal('amount', 10, 2);
            $table->string('gifted_to_email')->nullable();
            $table->string('gifted_to_phone')->nullable();
            $table->string('gifted_to_name')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_projects');
    }
};
