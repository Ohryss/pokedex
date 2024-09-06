<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class MoveLearnMethod extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $table = 'move_learn_methods';
    protected $fillable = ['identifier'];

    public function PokemonLearnMove()
    {
        return $this->hasMany(PokemonLearnMove::class);
    }
    public function MoveLearnMethodTranslation()
    {
        return $this->hasMany(MoveLearnMethodTranslation::class);
    }
}
