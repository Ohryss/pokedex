<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTranslation extends Model
{
    use HasFactory;

    protected $table = 'item_translations';
    protected $fillable = ['item_id', 'language_id', 'name', 'description'];
}
