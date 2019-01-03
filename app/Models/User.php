<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array $hidden
     */
    protected $hidden = ['password', 'remember_token'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function isAdmin()
    {
        return $this->admin === 1 ? true : false;
    }
}
