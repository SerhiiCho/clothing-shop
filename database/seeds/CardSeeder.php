<?php

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    public function run()
    {
        factory(Card::class, 3)->create();
    }
}
