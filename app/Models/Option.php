<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
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
}
