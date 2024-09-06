<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameVersion extends Model
{
    use HasFactory;

    protected $table = 'game_versions';
    protected $fillable = ['identifier'];

    public function translations()
    {
        return $this->hasMany(GameVersionTranslation::class);
    }
}
