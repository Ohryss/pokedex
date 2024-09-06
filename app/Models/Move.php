<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;

    protected $table = 'moves';
    protected $fillable = ['identifier', 'type_id', 'power', 'accuracy', 'pp', 'damage_class_id'];

    public function translations()
    {
        return $this->hasMany(MoveTranslation::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function damageClass()
    {
        return $this->belongsTo(MoveDamageClass::class, 'damage_class_id');
    }
}
