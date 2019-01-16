<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

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
     * Relation with View model
     */
    public function views()
    {
        return $this->hasMany(View::class);
    }

    /**
     * Relationship with ItemsPhoto model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(ItemsPhoto::class);
    }

    /**
     * Relationship with Order model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Relationship with Type model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Eloquent scope
     *
     * @param $query
     * @return object
     */
    public function scopeInStock($query): object
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Method for search
     *
     * @param string $word
     * @return object
     */
    public static function getByTitleOrTypeName(string $word)
    {
        return self::whereHas('type', function ($query) use ($word) {
            $query->where('name', 'like', "%{$word}%")
                ->orWhere('title', 'like', "%{$word}%");
        })->simplePaginate(20);
    }
}
