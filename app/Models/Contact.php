<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $timestamps = false;
	protected $fillable = ['phone', 'icon_id'];

	public function icon()
	{
		return $this->belongsTo(Icon::class);
	}
}
