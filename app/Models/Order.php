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

    /**
     * Disable updated_at field
     */
    const UPDATED_AT = null;

    /**
     * Relation with Item model
     */
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    /**
     * Accessor that formats created_at record to readable format
     */
    public function getCreatedAtAttribute($value)
    {
        return facebookTimeAgo($value);
    }
}
