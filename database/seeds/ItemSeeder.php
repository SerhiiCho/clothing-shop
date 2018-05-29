<?php

use App\Models\Item;
use App\Models\ItemsPhoto;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
		factory(Item::class, 25)->create()->each(function($item) {
			$item->photos()->save(factory(ItemsPhoto::class)->make());
		});
    }
}
