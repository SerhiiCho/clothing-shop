<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsPhoto extends Model
{
	protected $fillable = ['item_id', 'name'];
	
	public function item()
	{
		return $this->belongsTo(Item::class);
	}
}
