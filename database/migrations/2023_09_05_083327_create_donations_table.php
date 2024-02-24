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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->index();
            $table->foreignId('category_id')->index();
            $table->foreignId('project_id')->index();
            $table->string('project_code')->nullable();
            $table->foreignId('transaction_id')->index()->nullable();
            $table->string('reference');
            $table->string('payment_method');
            $table->decimal('amount', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->string('result');
            $table->foreignId('user_id')->index();
            $table->string('donor_name');
            $table->string('donor_phone');
            $table->boolean('is_zakat');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
