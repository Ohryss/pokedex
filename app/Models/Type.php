<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relation Many-to-Many avec PokemonVariety.
     */
    public function pokemonVarieties()
    {
        return $this->belongsToMany(PokemonVariety::class, 'pokemon_variety_type');
    }
}
