<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];
    const UPDATED_AT = null;

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return facebookTimeAgo($value);
    }
}
