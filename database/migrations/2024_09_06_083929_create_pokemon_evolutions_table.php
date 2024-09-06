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
        Schema::create('pokemon_evolutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pokemon_variety_id')->constrained('pokemon_varieties');
            $table->foreignId('evolves_to_id')->constrained('pokemon_varieties');
            $table->boolean('gender')->nullable();
            $table->foreignId('held_item_id')->nullable()->constrained('items');
            $table->foreignId('item_id')->nullable()->constrained('items');
            $table->foreignId('know_move_id')->nullable()->constrained('moves');
            $table->foreignId('know_move_type_id')->nullable()->constrained('types');
            $table->string('location')->nullable();
            $table->integer('min_affection')->nullable();
            $table->integer('min_happiness')->nullable();
            $table->integer('min_level')->nullable();
            $table->boolean('need_overworld_rain')->default(false);
            $table->foreignId('party_species_id')->nullable()->constrained('pokemons');
            $table->foreignId('party_type_id')->nullable()->constrained('types');
            $table->integer('relative_physical_stats')->nullable();
            $table->string('time_of_day')->nullable();
            $table->foreignId('trade_species_id')->nullable()->constrained('pokemons');
            $table->boolean('turn_upside_down')->default(false);
            $table->foreignId('evolution_trigger_id')->constrained('evolution_triggers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_evolutions');
    }
};
