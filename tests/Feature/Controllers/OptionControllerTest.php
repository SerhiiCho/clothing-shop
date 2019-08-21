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
    public function admin_can_turn_off_men_category(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@menCategory'));

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
    public function admin_can_remove_cache_data(): void
    {
        $this->get('/');

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@cacheForget'));

        array_map(function ($name) {
            $this->assertNull(cache()->get($name));
        }, config('cache.cache_names'));
    }

    /**
     * Method helper
     *
     * @param string $option
     * @param int $value
     * @return void
     */
    public function assertOptionHasValue(string $option, int $value)
    {
        $this->assertDatabaseHas('options', compact('option', 'value'));
    }
}
