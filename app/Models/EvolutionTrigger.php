<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class EvolutionTrigger extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];

    protected $table = 'evolution_triggers';
    protected $fillable = ['identifier'];

    public function PokemonEvolution()
    {
        return $this->belongsToMany(PokemonEvolution::class);
    }
}
