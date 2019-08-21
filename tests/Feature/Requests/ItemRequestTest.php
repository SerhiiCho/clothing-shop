<?php

namespace Tests\Feature\Requests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemRequestTest extends TestCase
{
    use DatabaseTransactions;

    private $form_data;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->form_data = [
            'title' => string_random(7),
            'content' => string_random(12),
            'category' => 'category1',
            'type' => rand(1, 10),
            'stock' => rand(1, config('valid.item.stock.max')),
            'price' => rand(1, 10000),
        ];
    }
    /** @test */
    public function title_is_not_required(): void
    {
        $this->form_data['title'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function content_is_not_required(): void
    {
        $this->form_data['content'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function category_is_not_required(): void
    {
        $this->form_data['category'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function type_is_not_required(): void
    {
        $this->form_data['type'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function stock_is_not_required(): void
    {
        $this->form_data['stock'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function price_is_not_required(): void
    {
        $this->form_data['price'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function type_must_be_numeric(): void
    {
        $this->form_data['type'] = 'text';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function stock_must_be_numeric(): void
    {
        $this->form_data['stock'] = 'text';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function price_must_be_numeric(): void
    {
        $this->form_data['price'] = 'text';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function stock_must_be_between_two_numbers(): void
    {
        $this->form_data['stock'] = config('valid.item.stock.min') - 1;
        $this->makeRequestAndCheckDatabase();

        $this->form_data['stock'] = config('valid.item.stock.max') + 1;
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function price_must_between_two_numbers(): void
    {
        $this->form_data['price'] = config('valid.item.price.min') - 1;
        $this->makeRequestAndCheckDatabase();

        $this->form_data['price'] = config('valid.item.price.max') + 1;
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function title_must_have_min_length(): void
    {
        $title_min = config('valid.item.title.min');

        $this->form_data['title'] = string_random($title_min - 1);
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function title_must_have_max_length(): void
    {
        $title_max = config('valid.item.title.max');

        $this->form_data['title'] = string_random($title_max + 1);
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function content_must_have_min_length(): void
    {
        $content_min = config('valid.item.content.min');

        $this->form_data['content'] = string_random($content_min - 1);
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function content_must_have_max_length(): void
    {
        $content_max = config('valid.item.content.max');

        $this->form_data['content'] = string_random($content_max + 1);
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function category_must_have_max_length(): void
    {
        $category_max = config('valid.item.category.max');

        $this->form_data['category'] = string_random($category_max + 1);
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * Method helper
     *
     * @return void
     */
    private function makeRequestAndCheckDatabase(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->post(action('ItemController@store'), $this->form_data);

        $this->assertDatabaseMissing('items', [
            'title' => $this->form_data['title'],
        ]);
    }
}
