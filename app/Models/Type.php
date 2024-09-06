<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Type extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['name'];

    /**
     * Relation Many-to-Many avec PokemonVariety.
     */
    public function pokemonVarieties()
    {
        return $this->belongsToMany(PokemonVariety::class, 'pokemon_variety_type');
    }
}
