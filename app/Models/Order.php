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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    /**
     * Relationship with User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor that formats created_at record to readable format
     */
    public function getCreatedAtAttribute($value)
    {
        return facebookTimeAgo($value);
    }

    /**
     * @param $user
     * @return bool
     */
    public function isTakenBy($user): bool
    {
        if ($this->user()->exists() && $this->user->id == $user->id) {
            return true;
        }
        return false;
    }
}
