<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Relation Many-to-Many avec PokemonVariety.
     */
    public function pokemonVarieties()
    {
        return $this->belongsToMany(PokemonVariety::class, 'ability_pokemon_variety');
    }
}
