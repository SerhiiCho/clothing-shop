<?php

namespace Tests\Feature\Views\Items;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemsCreatePageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get("/items/create")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest(): void
    {
        $this->get("/items/create")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get("/items/create")
            ->assertOk()
            ->assertViewIs('items.create');
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_add_new_items(): void
    {
        $form_data = [
            'title' => str_random(7),
            'content' => str_random(12),
            'category' => 'men',
            'type' => rand(1, 10),
            'stock' => rand(1, config('valid.item.stock.max')),
            'price' => rand(1, 10000),
        ];

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->post(action('ItemController@store'), $form_data);

        $this->assertDatabaseHas('items', [
            'title' => $form_data['title'],
        ]);
    }
}
