<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    public $timestamps = false;
	public $fillable = ['name', 'image'];

	public function contact()
	{
		return $this->belongsTo(Contact::class);
	}
}
