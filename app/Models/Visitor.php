<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    /**
     * Guarder columns
     *
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * Relationship with View model
     */
    public function views()
    {
        return $this->hasMany(View::class);
    }

    /**
     * Uses updateOrCreate eloquent method
     */
    public static function updateOrCreateNewVisitor()
    {
        return self::updateOrCreate(
            ['ip' => request()->ip()],
            ['updated_at' => now()]
        );
    }
}
