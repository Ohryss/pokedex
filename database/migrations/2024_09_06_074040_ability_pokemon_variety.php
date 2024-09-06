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
            $table->foreignId('ability_id')->constrained('abilities'); // Clé étrangère vers la table abilities
            $table->foreignId('pokemon_variety_id')->constrained('pokemon_varieties'); // Clé étrangère vers la table pokemon_varieties
            $table->boolean('is_hidden')->default(false);
            $table->integer('slot');
            $table->timestamps(); // Pour ajouter les colonnes created_at et updated_at
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
