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

    /**
     * @param string $option
     * @param string $value
     * @return void
     */
    public static function set(string $option, string $value): void
    {
        self::whereOption($option)->update(compact('option', 'value'));
    }
}
