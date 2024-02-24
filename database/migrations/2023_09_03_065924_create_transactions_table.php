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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->index();
            $table->foreignId('tag_id')->index();
            $table->string('continent');
            $table->foreignId('country_id')->index();
            $table->foreignId('project_id')->index();
            $table->string('project_code')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->decimal('amount', 10, 2);
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
