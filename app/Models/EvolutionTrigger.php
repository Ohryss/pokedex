<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvolutionTrigger extends Model
{
    use HasFactory;

    protected $table = 'evolution_triggers';
    protected $fillable = ['identifier'];

    public function translations()
    {
        return $this->hasMany(EvolutionTriggerTranslation::class);
    }
}
