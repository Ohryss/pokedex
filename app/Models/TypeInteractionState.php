<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeInteractionState extends Model
{
    use HasFactory;

    protected $table = 'type_interaction_states';
    protected $fillable = ['name'];

    public function typeInteractions()
    {
        return $this->hasMany(TypeInteraction::class);
    }
}
