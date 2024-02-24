<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('menu_items');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('link')->nullable();
            $table->foreignId('parent_id')->default(0);
            $table->integer('sort')->default(0);
            $table->string('class')->nullable();
            $table->foreignId('menu_id');
            $table->integer('depth')->default(0);
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_mega')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('menu_items');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
