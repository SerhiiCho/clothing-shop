<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    /**
     * Guarder columns
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Use or not laravel timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Relationship with Visitor model
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    /**
     * Relationship with Item model
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
