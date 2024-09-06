<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Move extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $table = 'moves';
    protected $fillable = ['identifier', 'type_id', 'power', 'accuracy', 'pp', 'damage_class_id'];

    public function PokemonLearnMove()
    {
        return $this->hasMany(PokemonLearnMove::class);
    }
    public function PokemonEvolution()
    {
        return $this->hasMany(PokemonEvolution::class);
    }
    public function MoveDamageClass()
    {
        return $this->belongsTo(MoveDamageClass::class);
    }
    public function Type()
    {
        return $this->belongsTo(Type::class);
    }
}
