<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $fillable = [
    'github_id',
    'name',
    'email',
    'profil_picture_url',
    'locale',
    'theme',
    'password',
  ];

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function favorites()
  {
      return $this->belongsToMany(Pokemon::class, 'pokemon_user', 'user_id', 'pokemon_id');
  }
  
  

}
