<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveLearnMethod extends Model
{
    use HasFactory;

    protected $table = 'move_learn_methods';
    protected $fillable = ['identifier'];

    public function translations()
    {
        return $this->hasMany(MoveLearnMethodTranslation::class);
    }
}
