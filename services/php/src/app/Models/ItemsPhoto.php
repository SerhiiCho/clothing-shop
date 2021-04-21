<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsPhoto extends Model
{
    /**
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * Relationship with Item model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
