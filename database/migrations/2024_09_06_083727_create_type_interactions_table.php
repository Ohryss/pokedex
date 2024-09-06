<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('type_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_type_id')->constrained('types');
            $table->foreignId('to_type_id')->constrained('types');
            $table->foreignId('type_interaction_state_id')->constrained('type_interaction_states');
            $table->unique(['from_type_id', 'to_type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('type_interactions');
    }
};
