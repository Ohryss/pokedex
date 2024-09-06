<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
 
class Item extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $table = 'items';
    protected $fillable = ['identifier', 'cost'];
    public function PokemonEvolution()
    {
        return $this->hasMany(PokemonEvolution::class);
    }
}
