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
    public function admin_can_turn_off_first_category(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@firstCategory'));

        $this->assertOptionHasValue('category1', 0);
    }

    /** @test */
    public function admin_can_turn_on_fitst_category_if_option_input_is_checked(): void
    {
        Option::set('category1', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@firstCategory'), ['option' => 'on']);

        $this->assertOptionHasValue('category1', 1);
    }

    /** @test */
    public function admin_cant_turn_on_fitst_category_if_option_input_is_not_checked(): void
    {
        Option::set('category1', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@firstCategory'), ['option' => 'off']);

        $this->assertOptionHasValue('category1', 0);
    }

    /** @test */
    public function admin_can_turn_off_second_category(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@secondCategory'));

        $this->assertOptionHasValue('category2', 0);
    }

    /** @test */
    public function admin_can_turn_on_second_category_if_option_input_is_checked(): void
    {
        Option::set('category2', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@secondCategory'), ['option' => 'on']);

        $this->assertOptionHasValue('category2', 1);
    }

    /** @test */
    public function admin_cant_turn_on_second_category_if_option_input_is_not_checked(): void
    {
        Option::set('category2', 0);

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@secondCategory'), ['option' => 'off']);

        $this->assertOptionHasValue('category2', 0);
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
    public function admin_can_change_Category1Title_option(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@categoryTitle'), [
                'second' => $new_title = string_random(7),
                'first' => 'value',
            ]);

        $this->assertOptionHasValue('category2_title', $new_title);
    }

    /** @test */
    public function admin_can_change_MenCategoryTitle_option(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@categoryTitle'), [
                'first' => $new_title = string_random(7),
                'second' => 'title',
            ]);

        $this->assertOptionHasValue('category1_title', $new_title);
    }

    public function assertOptionHasValue(string $option, $value)
    {
        $this->assertDatabaseHas('options', compact('option', 'value'));
    }
}
