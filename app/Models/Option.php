<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var bool
     */
    public $timestamps = false;

    public static function set(string $option, int $value): void
    {
        cache()->forget('admin_options');
        self::whereOption($option)->update(compact('option', 'value'));
    }
}
