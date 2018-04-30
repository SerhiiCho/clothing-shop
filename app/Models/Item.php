<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	// The attributes that are mass assignable.
    protected $guarded = ['id'];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function type() {
		return $this->belongsTo(Type::class);
	}
}
