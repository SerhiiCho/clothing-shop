<?php

namespace App\Observers;

use App\Models\Card;
use Illuminate\Support\Facades\Storage;

class CardObserver
{
    /**
     * Deleting card image if card is being deleted
     *
     * @return void
     */
    public function deleting(Card $card): void
    {
        if ($card->image != 'default.jpg') {
            Storage::delete("public/img/cards/{$card->image}");
        }
    }
}
