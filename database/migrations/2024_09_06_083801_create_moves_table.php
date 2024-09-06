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
        Schema::create('moves', function (Blueprint $table) {
            $table->id();
            $table->integer('accuracy')->nullable();
            $table->foreignId('move_damage_class_id')->constrained('move_damage_classes');
            $table->integer('power')->nullable();
            $table->integer('pp');
            $table->integer('priority');
            $table->foreignId('type_id')->constrained('types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moves');
    }
};
