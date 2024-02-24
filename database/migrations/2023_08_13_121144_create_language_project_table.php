<?php

use App\Enums\LanguageProjectStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('language_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index();
            $table->foreignId('language_id')->index();
            $table->enum('status', array_column(LanguageProjectStatus::cases(), 'value'));
            $table->tinyInteger('order')->default(0);
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->text('short_description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_project');
    }
};
