<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Ability extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'description', 'effect'];

    protected $fillable = ['name', 'description', 'effect'];

    /**
     * Relation Many-to-Many avec PokemonVariety.
     */
    public function PokemonVariety()
    {
        return $this->belongsToMany(PokemonVariety::class)
                    ->withPivot('is_hidden');
    }
}
