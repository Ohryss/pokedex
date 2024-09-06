<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbilityTranslation extends Model
{
    use HasFactory;

    protected $table = 'ability_translations';
    protected $fillable = ['ability_id', 'language_id', 'name'];

}
