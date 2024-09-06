<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveDamageClassTranslation extends Model
{
    use HasFactory;

    protected $table = 'move_damage_class_translations';
    protected $fillable = ['move_damage_class_id', 'language_id', 'name'];

    public function moveDamageClass()
    {
        return $this->belongsTo(MoveDamageClass::class);
    }
}
