<?php

namespace Tests\Feature\Controllers;

use App\Models\Option;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OptionControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function option_Registration_is_on_by_default(): void
    {
        $this->assertOptionHasValue('registration', 1);
    }

    /**
     * @author Cho
     * @test
     */
    public function option_MenCategory_is_on_by_default(): void
    {
        $this->assertOptionHasValue('men_category', 1);
    }

    /**
     * @author Cho
     * @test
     */
    public function option_WomenCategory_is_on_by_default(): void
    {
        $this->assertOptionHasValue('women_category', 1);
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_turn_off_registration(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@registration'));

        $this->assertOptionHasValue('registration', 0);
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_turn_off_men_category(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@menCategory'));

        $this->assertOptionHasValue('men_category', 0);
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_turn_off_women_category(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@womenCategory'));

        $this->assertOptionHasValue('women_category', 0);
    }

    /**
     * @author Cho
     * @test
     */
    public function auth_user_cant_turn_off_men_category(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->put(action('Admin\OptionController@menCategory'));

        $this->assertOptionHasValue('men_category', 1);
    }

    /**
     * @author Cho
     * @test
     */
    public function auth_user_cant_turn_off_women_category(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->put(action('Admin\OptionController@womenCategory'));

        $this->assertOptionHasValue('women_category', 1);
    }

    /**
     * @author Cho
     * @test
     */
    public function auth_user_cant_turn_off_registration(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->put(action('Admin\OptionController@registration'));

        $this->assertOptionHasValue('registration', 1);
    }

    /**
     * @author Cho
     * @test
     */
    public function guest_cant_turn_off_registration(): void
    {
        $this->put(action('Admin\OptionController@registration'));
        $this->assertOptionHasValue('registration', 1);
    }

    /**
     * @author Cho
     * @test
     */
    public function guest_cant_turn_off_men_category(): void
    {
        $this->put(action('Admin\OptionController@menCategory'));
        $this->assertOptionHasValue('men_category', 1);
    }

    /**
     * @author Cho
     * @test
     */
    public function guest_cant_turn_off_women_category(): void
    {
        $this->put(action('Admin\OptionController@womenCategory'));
        $this->assertOptionHasValue('women_category', 1);
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
