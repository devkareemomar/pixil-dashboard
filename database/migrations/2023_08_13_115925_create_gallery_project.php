<?php

use App\Enums\GalleryProjectStatus;
use App\Enums\GalleryProjectType;
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
        Schema::create('project_gallery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index();
            $table->string('path');
            $table->enum('status', array_column(GalleryProjectStatus::cases(), 'value'))->default(GalleryProjectStatus::Active->value);
            $table->tinyInteger('order')->default(0);
            $table->enum('type', array_column(GalleryProjectType::cases(), 'value'));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_project');
    }
};
