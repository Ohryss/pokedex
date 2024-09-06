<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveDamageClass extends Model
{
    use HasFactory;

    protected $table = 'move_damage_classes';
    protected $fillable = ['name'];

    public function translations()
    {
        return $this->hasMany(MoveDamageClassTranslation::class);
    }
}
