<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	public $timestamps = false;
	public $fillable = ['phone', 'icon'];
}
