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
        Schema::create('ability_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ability_id')->constrained('abilities');
            $table->string('locale');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unique(['ability_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ability_translations');
    }
};
