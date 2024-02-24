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
        Schema::create('order_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('project_id');
            $table->unsignedInteger('qty');
            $table->decimal('price');
            $table->decimal('tax_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_projects');
    }
};
