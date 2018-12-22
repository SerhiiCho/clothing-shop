<?php

namespace Tests\Feature\Views\Items;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemsEditPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $item = factory(Item::class)->create();
        $user = factory(User::class)->create([
            'admin' => 1,
        ]);

        $this->actingAs($user)
            ->get("/items/{$item->id}/edit")
            ->assertOk()
            ->assertViewIs('items.edit');
    }
}
