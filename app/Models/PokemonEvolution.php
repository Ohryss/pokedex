<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonEvolution extends Model
{
    use HasFactory;

    protected $table = 'pokemon_evolutions';
    protected $fillable = ['pokemon_id', 'evolution_trigger_id', 'trigger_item_id', 'minimum_level'];

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }

    public function trigger()
    {
        return $this->belongsTo(EvolutionTrigger::class, 'evolution_trigger_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'trigger_item_id');
    }
}
