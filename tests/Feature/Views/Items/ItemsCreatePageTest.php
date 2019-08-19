<?php

namespace Tests\Feature\Views\Items;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ItemsCreatePageTest extends TestCase
{
    use DatabaseTransactions;

    private $admin;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->admin = factory(User::class)->state('admin')->create();
    }

    /** @test */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get("/items/create")
            ->assertRedirect();
    }

    /** @test */
    public function page_is_not_accessible_by_guest(): void
    {
        $this->get("/items/create")
            ->assertRedirect();
    }

    /** @test */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs($this->admin)
            ->get("/items/create")
            ->assertOk()
            ->assertViewIs('items.create');
    }

    /** @test */
    public function admin_can_add_new_items(): void
    {
        $form_data = $this->generateFormData(false);

        $this->actingAs($this->admin)
            ->post(action('ItemController@store'), $form_data)
            ->assertRedirect();

        $this->assertDatabaseHas('items', [
            'title' => $form_data['title'],
        ]);
    }

    /** @test */
    public function admin_can_upload_image(): void
    {
        $form_data = $this->generateFormData(true);

        $this->actingAs($this->admin)
            ->post(action('ItemController@store'), $form_data)
            ->assertRedirect();

        $item = Item::whereTitle($form_data['title'])->first();
        $photo = $item->photos()->first()->name;

        $this->assertEquals(1, $item->photos()->count());
        $this->assertNotEquals('default.jpg', $photo);
        $this->assertImagesExist($photo);
    }

    /** @test */
    public function admin_can_change_image(): void
    {
        $form_data = $this->generateFormData(true);
        $item = factory(Item::class)->create();

        $this->actingAs($this->admin)
            ->put(action('ItemController@update', [
                'id' => $item->slug,
            ]), $form_data)
            ->assertRedirect();

        $this->assertEquals(1, $item->photos()->count());
        $this->assertImagesExist($item->photos()->first()->name);
    }

    /** @test */
    public function image_is_deleted_with_the_item(): void
    {
        $form_data = $this->generateFormData(true);

        // Create item with image
        $this->actingAs($this->admin)
            ->post(action('ItemController@store'), $form_data)
            ->assertRedirect();

        $item = Item::whereTitle($form_data['title'])->first();
        $photo = $item->photos()->first()->name;

        // Delete items with photos
        $this->actingAs($this->admin)->delete("/api/item/{$item->slug}");

        $this->assertEquals(0, $item->photos()->count());
        $this->assertFileNotExists(storage_path("app/public/img/big/clothes/{$photo}"));
        $this->assertFileNotExists(storage_path("app/public/img/small/clothes/{$photo}"));
    }

    /**
     * Method helper
     *
     * @param bool $with_photo
     * @return array
     */
    private function generateFormData(bool $with_photo): array
    {
        $form_data = [
            'title' => string_random(7),
            'content' => string_random(12),
            'category' => 'men',
            'type' => rand(1, 10),
            'stock' => rand(1, config('valid.item.stock.max')),
            'price' => rand(1, 10000),
        ];

        if ($with_photo) {
            $form_data['photos'] = [UploadedFile::fake()->image('image.jpg')];
        }

        return $form_data;
    }

    /**
     * @param string $photo
     * @return void
     */
    private function assertImagesExist(string $photo): void
    {
        $this->assertFileExists(storage_path("app/public/img/big/clothes/{$photo}"));
        $this->assertFileExists(storage_path("app/public/img/small/clothes/{$photo}"));

        \Storage::delete([
            "public/img/big/clothes/{$photo}",
            "public/img/small/clothes/{$photo}",
        ]);
    }
}
