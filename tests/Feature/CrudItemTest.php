<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Item;
use App\Models\User;
use App\Models\ItemsPhoto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CrudItemTest extends TestCase
{
	use DatabaseTransactions;

    public function testItemCanBeCreated()
    {
		$item = factory(Item::class)->create();

		$photos = new Collection([
			factory(ItemsPhoto::class)->make(['item_id' => $item->id]),
			factory(ItemsPhoto::class)->make(['item_id' => $item->id]),
		]);

		$item->photos()->saveMany($photos);

		$this->assertDatabaseHas('items', ['id' => $item->id])
			->assertDatabaseHas('items_photos', ['item_id' => $item->id]);
	}


	public function testItemCanBeDeleted()
	{
		factory(Item::class)->create(['title' => 'Short skirt']);

		$this->assertDatabaseHas('items', ['title' => 'Short skirt'])
			->assertTrue(Item::latest()->first()->delete());

		$look_for_item = Item::where('title', 'Short skirt')->count();
		$this->assertEquals(0, $look_for_item);
	}
}
