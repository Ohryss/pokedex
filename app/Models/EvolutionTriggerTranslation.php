<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvolutionTriggerTranslation extends Model
{
    use HasFactory;

    protected $table = 'evolution_trigger_translations';
    protected $fillable = ['evolution_trigger_id', 'language_id', 'name'];

    public function evolutionTrigger()
    {
        return $this->belongsTo(EvolutionTrigger::class);
    }
}
