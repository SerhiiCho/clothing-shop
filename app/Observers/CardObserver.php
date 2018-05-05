<?php

namespace App\Observers;

use App\Models\Card;
use Illuminate\Support\Facades\Storage;

class CardObserver
{
	// Deleting card image if card is being deleted
	public function deleting(Card $card)
	{
		Storage::delete('public/img/cards/'.$card->image);
	}
}