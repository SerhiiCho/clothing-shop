<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /**
     * @var bool $timestamp
     */
    public $timestamps = false;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    public function card()
    {
        return $this->hasOne(Card::class);
    }
}
