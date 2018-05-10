<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // The attributes that are mass assignable.
    protected $fillable = ['name', 'email', 'password'];

    // The attributes that should be hidden for arrays.
    protected $hidden = ['password', 'remember_token',];
	
	public function items() {
		return $this->hasMany(Item::class);
	}
}
