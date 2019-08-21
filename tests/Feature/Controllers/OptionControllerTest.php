<?php

namespace Tests\Feature\Controllers;

use App\Models\Option;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OptionControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function admin_can_turn_off_registration(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@registration'));

        $this->assertOptionHasValue('registration', 0);
    }

    /** @test */
    public function admin_can_turn_on_registration_if_option_input_is_checked(): void
    {
        Option::set('registration', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@registration'), ['option' => 'on']);

        $this->assertOptionHasValue('registration', 1);
    }

    /** @test */
    public function admin_cant_turn_on_registration_if_option_input_is_not_checked(): void
    {
        Option::set('registration', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@registration'), ['option' => 'off']);

        $this->assertOptionHasValue('registration', 0);
    }

    /** @test */
    public function admin_can_turn_off_men_category(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@menCategory'));

        $this->assertOptionHasValue('men_category', 0);
    }

    /** @test */
    public function admin_can_turn_on_men_category_if_option_input_is_checked(): void
    {
        Option::set('men_category', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@menCategory'), ['option' => 'on']);

        $this->assertOptionHasValue('men_category', 1);
    }

    /** @test */
    public function admin_cant_turn_on_men_category_if_option_input_is_not_checked(): void
    {
        Option::set('men_category', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@menCategory'), ['option' => 'off']);

        $this->assertOptionHasValue('men_category', 0);
    }

    /** @test */
    public function admin_can_turn_off_women_category(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@womenCategory'));

        $this->assertOptionHasValue('women_category', 0);
    }

    /** @test */
    public function admin_can_turn_on_women_category_if_option_input_is_checked(): void
    {
        Option::set('women_category', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@womenCategory'), ['option' => 'on']);

        $this->assertOptionHasValue('women_category', 1);
    }

    /** @test */
    public function admin_cant_turn_on_women_category_if_option_input_is_not_checked(): void
    {
        Option::set('women_category', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@womenCategory'), ['option' => 'off']);

        $this->assertOptionHasValue('women_category', 0);
    }

    /** @test */
    public function admin_can_remove_cache_data(): void
    {
        $this->get('/');

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@cacheForget'));

        array_map(function ($name) {
            $this->assertNull(cache()->get($name));
        }, config('cache.cache_names'));
    }

    /** @test */
    public function admin_can_change_WomenCategoryTitle_option(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@categoryTitle'), [
                'women' => $new_title = string_random(7),
                'men' => 'value',
            ]);

        $this->assertOptionHasValue('women_category_title', $new_title);
    }

    /** @test */
    public function admin_can_change_MenCategoryTitle_option(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@categoryTitle'), [
                'men' => $new_title = string_random(7),
                'women' => 'title',
            ]);

        $this->assertOptionHasValue('men_category_title', $new_title);
    }

    public function assertOptionHasValue(string $option, $value)
    {
        $this->assertDatabaseHas('options', compact('option', 'value'));
    }
}
