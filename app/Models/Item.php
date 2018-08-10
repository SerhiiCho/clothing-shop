<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = ['id'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(ItemsPhoto::class);
    }

    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function getByTitleOrTypeName($word)
    {
        return self::whereHas('type', function ($query) use ($word) {
            $query
                ->where('name', 'like', '%' . $word . '%')
                ->orWhere('title', 'like', '%' . $word . '%');
        })->simplePaginate(20);
    }
}
