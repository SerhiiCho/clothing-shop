<?php

namespace Tests\Feature\Views\Items;

use App\Models\Item;
use App\Models\ItemsPhoto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemsShowPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_guest(): void
    {
        $item = factory(Item::class)->create();

        $this->get("/item/{$item->category}/{$item->id}")
            ->assertOk()
            ->assertViewIs('items.show');
    }

    /**
     * @author Cho
     * @test
     */
    public function item_can_be_created()
    {
        $item = factory(Item::class)->create();

        $photos = new Collection([
            factory(ItemsPhoto::class)->make(['item_id' => $item->id]),
            factory(ItemsPhoto::class)->make(['item_id' => $item->id]),
        ]);

        $item->photos()->saveMany($photos);

        $this->assertDatabaseHas('items', ['id' => $item->id]);
        $this->assertDatabaseHas('items_photos', ['item_id' => $item->id]);
    }

    /**
     * @author Cho
     * @test
     */
    public function item_can_be_deleted()
    {
        factory(Item::class)->create(['title' => 'Short skirt']);

        $this->assertDatabaseHas('items', ['title' => 'Short skirt']);
        $this->assertTrue(Item::latest()->first()->delete());

        $look_for_item = Item::where('title', 'Short skirt')->count();
        $this->assertEquals(0, $look_for_item);
    }
}
