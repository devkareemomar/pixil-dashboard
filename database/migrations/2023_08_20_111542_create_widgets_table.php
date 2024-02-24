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
        Schema::create('widgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->foreignId('widget_category_id')->constrained('widget_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('thumbnail');
            $table->json('payload');
            $table->tinyInteger('order');
            $table->double('size_percentage');
            $table->timestamps();

            $table->unique(['section_id','order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widgets');
    }
};
