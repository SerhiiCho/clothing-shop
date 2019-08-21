<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * @var bool $timestamp
     */
    public $timestamps = false;

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public static function getCards(): array
    {
        return self::with('type')->get()->take(3)->toArray();
    }
}
