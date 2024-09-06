<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTranslation extends Model
{
    use HasFactory;

    protected $table = 'type_translations';

    protected $fillable = [
        'type_id',
        'locale',
        'name'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
