<?php

use App\Enums\ItemMenuType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_menu', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', array_column(ItemMenuType::cases(), 'value')); // 1: Page, 2: Project
            $table->foreignId('item_id')->index();
            $table->tinyInteger('order')->default(0);
            $table->foreignId('menu_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
