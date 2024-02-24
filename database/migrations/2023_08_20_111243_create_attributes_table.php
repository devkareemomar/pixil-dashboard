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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('input_type_id')->constrained('input_types')->onDelete('cascade');
            $table->integer('min_quantity')->nullable();
            $table->integer('max_quantity')->nullable();
            $table->boolean('desktop_visibility');
            $table->boolean('tablet_visibility');
            $table->boolean('mobile_visibility');
            $table->boolean('has_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
