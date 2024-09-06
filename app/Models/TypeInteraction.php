<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeInteraction extends Model
{
    use HasFactory;

    protected $table = 'type_interactions';
    protected $fillable = ['attacking_type_id', 'defending_type_id', 'state_id'];

    public function attackingType()
    {
        return $this->belongsTo(Type::class, 'attacking_type_id');
    }

    public function defendingType()
    {
        return $this->belongsTo(Type::class, 'defending_type_id');
    }

    public function state()
    {
        return $this->belongsTo(TypeInteractionState::class);
    }
}
