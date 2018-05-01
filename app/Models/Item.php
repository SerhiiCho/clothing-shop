<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = ['id'];

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function messages() {
		return $this->hasMany(Message::class);
	}

	public function type() {
		return $this->belongsTo(Type::class);
	}
}
