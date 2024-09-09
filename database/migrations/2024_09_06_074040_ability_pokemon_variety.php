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
        Schema::create('ability_pokemon_variety', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ability_id');
            $table->unsignedBigInteger('pokemon_variety_id');
            $table->boolean('is_hidden')->default(false);
            $table->integer('slot');
            $table->foreign('ability_id')->references('id')->on('abilities')->onDelete('cascade');
            $table->foreign('pokemon_variety_id')->references('id')->on('pokemon_varieties')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['ability_id', 'pokemon_variety_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ability_pokemon_variety');
    }
};


            
