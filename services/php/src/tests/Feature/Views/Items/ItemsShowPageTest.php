<?php

namespace Tests\Feature\Views\Items;

use App\Models\Item;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemsShowPageTest extends TestCase
{
    use DatabaseTransactions;

    private $item;
    private $url;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->item = factory(Item::class)->create();
        $this->url = "/item/{$this->item->category}/{$this->item->slug}";
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_guest(): void
    {

        $this->get($this->url)->assertOk()->assertViewIs('items.show');
    }
}
