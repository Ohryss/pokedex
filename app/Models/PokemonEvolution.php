<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonEvolution extends Model
{
    use HasFactory;

    protected $table = 'pokemon_evolutions';
    protected $fillable = ['pokemon_id', 'evolution_trigger_id', 'trigger_item_id', 'minimum_level'];

    public function pokemonVariety()
    {
        return $this->belongsTo(PokemonVariety::class, 'pokemon_variety_id');
    }
    public function party_species(){
        return $this->belongsTo(Pokemon::class, 'party_species_id');
    }

    public function trade_species(){
        return $this->belongsTo(Pokemon::class, 'trade_species_id');
    }

    public function evolvesTo()
    {
        return $this->belongsTo(PokemonEvolution::class, 'evolves_to_id');
    }

    public function heldItem()
    {
        return $this->belongsTo(Item::class, 'held_item_id');
    }

    public function item(){
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function knownMove(){
        return $this->belongsTo(Move::class, 'known_move_type_id');
    }

    public function knownMoveType(){
        return $this->belongsTo(Type::class, 'known_move_type_id');
    }

    public function evolutionTrigger()
    {
        return $this->belongsTo(EvolutionTrigger::class);
    }
}
 