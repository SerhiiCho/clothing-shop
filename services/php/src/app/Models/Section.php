<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var bool $timestamps
     */
    public $timestamps = false;
}
