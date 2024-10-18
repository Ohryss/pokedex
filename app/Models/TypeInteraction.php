<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeInteraction extends Model
{
    use HasFactory;

    protected $table = 'type_interactions';
    protected $fillable = ['from_type_id', 'to_type_id', 'type_interraction_state_id'];

    public function from_type_id()
    {
        return $this->belongsTo(Type::class, 'from_type_id');
    }

    public function to_type_id()
    {
        return $this->belongsTo(Type::class, 'to_type_id');
    }

    public function state()
    {
        return $this->belongsTo(TypeInteractionState::class);
    }
}
