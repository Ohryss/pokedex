<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonLearnMove extends Model
{
    use HasFactory;

    protected $table = 'pokemon_learn_moves';
    protected $fillable = ['pokemon_id', 'move_id', 'learn_method_id', 'version_group_id', 'level'];

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class);
    }

    public function move()
    {
        return $this->belongsTo(Move::class);
    }

    public function learnMethod()
    {
        return $this->belongsTo(MoveLearnMethod::class, 'learn_method_id');
    }

    public function versionGroup()
    {
        return $this->belongsTo(GameVersion::class, 'version_group_id');
    }
}
