<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;


class PokemonVariety extends Model implements TranslatableContract
{
  use HasFactory, Translatable;

  public $translatedAttributes = ['name', 'description', 'form_name'];

  protected $fillable = ['pokemon_id', 'is_default', 'cry_url', 'height', 'weight', 'base_experience', 'base_stats_hp', 'base_stats_attack', 'base_stats_defense', 'base_stats_special_attack', 'base_stats_special_defense', 'base_stats_speed'];

  protected $casts = [
    'is_default' => 'boolean',
  ];
  public function sprites()
  {
    return $this->hasOne(PokemonVarietySprite::class);
  }

  public function abilities(){
      return $this->belongsToMany(Ability::class);
  }

    public function evolutions(){
        return $this->hasMany(PokemonEvolution::class, 'pokemon_variety_id');
    }

    public function evolvesto(){
      return $this->hasMany(PokemonEvolution::class, 'evolves_to_id');
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'pokemon_variety_type');
    }

    public function learnMoves(){
        return $this->hasMany(PokemonLearnMove::class, 'pokemon_variety_id');
    }

    public function pokemon(){
        return $this->belongsTo(Pokemon::class);
    }
}