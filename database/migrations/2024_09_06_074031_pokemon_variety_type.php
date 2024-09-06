<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('pokemon_variety_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pokemon_variety_id');
            $table->unsignedBigInteger('type_id');
            $table->integer('slot');
            $table->foreign('pokemon_variety_id')->references('id')->on('pokemon_varieties')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->unique(['pokemon_variety_id', 'type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_variety_type');
    }
};
