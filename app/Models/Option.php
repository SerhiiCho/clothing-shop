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
     * @param int $value
     * @return void
     */
    public static function set(string $option, int $value): void
    {
        cache()->forget('admin_options');
        self::whereOption($option)->update(compact('option', 'value'));
    }
}
