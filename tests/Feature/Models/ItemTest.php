<?php

namespace Tests\Feature\Models;

use App\Models\Item;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function scope_InStock_returns_items_in_stock(): void
    {
        $item = factory(Item::class)->create(['stock' => 2]);
        $this->assertTrue(Item::whereId($item->id)->inStock()->exists());
    }

    /**
     * @author Cho
     * @test
     */
    public function scope_InStock_not_returns_items_not_in_stock(): void
    {
        $item = factory(Item::class)->create(['stock' => 0]);
        $this->assertFalse(Item::whereId($item->id)->inStock()->exists());
    }

    /**
     * @author Cho
     * @test
     */
    public function GetByTitleOrTypeName_method_returns_item_with_given_title_name(): void
    {
        $item = factory(Item::class)->create();
        $actual_title = Item::getByTitleOrTypeName($item->title)->first()->title;
        $this->assertEquals($item->title, $actual_title);
    }
}
