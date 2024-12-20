<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoveLearnMethodTranslation extends Model
{
    use HasFactory;

    protected $table = 'move_learn_method_translations';
    protected $fillable = ['move_learn_method_id', 'language_id', 'name', 'description'];
}
