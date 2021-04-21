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
    private $url;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->item = factory(Item::class)->create();
        $this->url = "/items/{$this->item->slug}/edit";
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get($this->url)
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest(): void
    {
        $this->get($this->url)->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get($this->url)
            ->assertOk()
            ->assertViewIs('items.edit');
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_update_items(): void
    {
        $item = factory(Item::class)->create();
        $admin = factory(User::class)->state('admin')->create();

        $form_data = [
            'title' => str_random(7),
            'content' => str_random(12),
            'category' => 'men',
            'type' => rand(1, 10),
            'stock' => rand(1, config('valid.item.stock.max')),
            'price' => rand(1, 10000),
        ];

        $this->actingAs($admin)
            ->put(action('ItemController@update', [
                'item' => $item->id,
            ]), $form_data);

        $this->assertDatabaseHas('items', [
            'title' => $form_data['title'],
        ]);
    }
}
