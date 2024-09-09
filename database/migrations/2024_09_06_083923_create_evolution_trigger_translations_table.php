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
        Schema::create('evolution_trigger_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evolution_trigger_id')->constrained('evolution_triggers');
            $table->string('locale');
            $table->string('name');
            $table->timestamps();

            $table->unique(['evolution_trigger_id', 'locale']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evolution_trigger_translations');
    }
};
