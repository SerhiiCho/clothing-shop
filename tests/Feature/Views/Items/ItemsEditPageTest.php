<?php

namespace Tests\Feature\Views\Items;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemsEditPageTest extends TestCase
{
    use DatabaseTransactions;

    private $item;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->item = factory(Item::class)->create();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get("/items/{$this->item->id}/edit")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest(): void
    {
        $this->get("/items/{$this->item->id}/edit")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get("/items/{$this->item->id}/edit")
            ->assertOk()
            ->assertViewIs('items.edit');
    }
}
