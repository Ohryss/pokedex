<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class GameVersion extends Model implements TranslatableContract
{
    use HasFactory, Translatable;


    public $translatedAttributes = ['name'];
    protected $table = 'game_versions';
    protected $fillable = ['identifier'];

    public function PokemonLearnMove()
    {
        return $this->hasMany(PokemonLearnMove::class);
    }
}
