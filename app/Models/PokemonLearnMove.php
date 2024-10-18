<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonLearnMove extends Model
{
    use HasFactory;

    protected $table = 'pokemon_learn_moves';
    protected $fillable = ['pokemon_variety_id', 'move_id', 'move_learn_method_id', 'game_version_id'];

    public function PokemonVariety()
    {
        return $this->belongsTo(PokemonVariety::class);
    }

    public function move()
    {
        return $this->belongsTo(Move::class);
    }

    public function learnMethod()
    {
        return $this->hasMany(MoveLearnMethod::class, "id");
    }
    public function versionGroup()
    {
        return $this->belongsTo(GameVersion::class, "game_version_id");
    }


}
