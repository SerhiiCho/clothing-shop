<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	public    $timestamps = false;
	protected $fillable = [ 'type' ];
	
    public function item() {
		return $this->belongsTo(Item::class);
	}
}
