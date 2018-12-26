<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var array $dates
     */
    protected $dates = ['deleted_at'];

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
