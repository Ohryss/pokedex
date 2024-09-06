<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameVersionTranslation extends Model
{
    use HasFactory;

    protected $table = 'game_version_translations';
    protected $fillable = ['game_version_id', 'language_id', 'name'];

    public function gameVersion()
    {
        return $this->belongsTo(GameVersion::class);
    }
}
