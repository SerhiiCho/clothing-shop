<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * @var string $table
     */
    protected $table = 'slider';

    /**
     * @var bool $timestamps
     */
    public $timestamps = false;
}
