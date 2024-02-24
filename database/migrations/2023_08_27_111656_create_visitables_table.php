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
        Schema::create('visitables', function (Blueprint $table) {
            $table->id();
            $table->morphs('visitable');
            $table->foreignId('user_id')->index()->nullable();
            $table->string('ip');
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['visitable_id', 'visitable_type', 'user_id', 'ip']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitables');
    }
};
