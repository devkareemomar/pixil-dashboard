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
        Schema::create('help_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nationality_id')->index();
            $table->string('service_status')->nullable();
            $table->string('gender');
            $table->foreignId('help_type_id')->index();
            $table->string('marital_status');
            $table->string('name');
            $table->bigInteger('civil_id');
            $table->integer('family_members');
            $table->string('job')->nullable();
            $table->string('salary')->nullable();
            $table->longText('address');
            $table->longText('other_information')->nullable();
            $table->string('phone');
            $table->string('file')->nullable();
            $table->longText('old_help_document')->nullable();
            $table->integer('reference_no')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('help_lists');
    }
};
