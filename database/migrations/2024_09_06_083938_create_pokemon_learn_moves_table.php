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
        Schema::create('pokemon_learn_moves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pokemon_variety_id')->constrained('pokemon_varieties');
            $table->foreignId('move_id')->constrained('moves');
            $table->foreignId('move_learn_method_id')->constrained('move_learn_methods');
            $table->foreignId('game_version_id')->constrained('game_versions');
            $table->integer('level')->default(0);
            $table->timestamps();
            
            $table->unique([
                'pokemon_variety_id', 
                'move_id', 
                'move_learn_method_id', 
                'game_version_id'
            ]);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon_learn_moves');
    }
};
