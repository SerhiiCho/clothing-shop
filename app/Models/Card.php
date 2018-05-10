<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
	protected $timestamps = false;
	protected $guarded = [ 'id' ];
	
	public function type()
	{
		return $this->belongsTo(Type::class);
	}
}
