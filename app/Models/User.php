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

    /**
     * Relationships with Item model
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->admin === 1 ? true : false;
    }

    /**
     * Check if user is master
     *
     * @return bool
     */
    public function isMaster(): bool
    {
        return $this->id === 1 ? true : false;
    }
}
