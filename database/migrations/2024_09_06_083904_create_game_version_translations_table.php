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
        Schema::create('game_version_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_version_id')->constrained('game_versions');
            $table->string('locale');
            $table->string('name');
            $table->timestamps();

            $table->unique(['game_version_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_version_translations');
    }
};
