<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = ['id'];

	// Relationships
	public function user() {
		return $this->belongsTo(User::class);
	}

	public function messages() {
		return $this->hasMany(Message::class);
	}

	public function type() {
		return $this->belongsTo(Type::class);
	}

	// Accessor
	public function getPrice1Attribute($value)
	{
		return $this->price2 == 0 ? $value : $value . '.';
	}

	// Accessor
	public function getPrice2Attribute($value)
	{
		if ($value == 0) {
			return '';
		} elseif (strlen($value) < 2) {
			return $value . '0';
		} else {
			return $value;
		}
	}

	public function getByTitleOrTypeName($word)
	{
		return self::whereHas('type', function ($query) use ($word) {
			$query
				->where('name', 'like', '%'.$word.'%')
				->orWhere('title', 'like', '%'.$word.'%');
		})->simplePaginate(20);
	}


}
