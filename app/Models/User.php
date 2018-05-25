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

	public function isMember()
	{
		return $this->member === 1 ? true : false;
	}

	public function isAdmin()
	{
		return $this->admin === 1 ? true : false;
	}

	public function isMaster()
	{
		return $this->master === 1 ? true : false;
	}

	public function isBlogger()
	{
		return $this->blogger === 1 ? true : false;
	}
}
