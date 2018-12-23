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
        $this->assertOptionHasValue('registration', 'on');
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_turn_off_registration(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->put(action('Admin\OptionController@registration'));

        $this->assertOptionHasValue('registration', 'off');
    }

    /**
     * @author Cho
     * @test
     */
    public function auth_user_cant_turn_off_registration(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->put(action('Admin\OptionController@registration'));

        $this->assertOptionHasValue('registration', 'on');
    }

    /**
     * @author Cho
     * @test
     */
    public function guest_cant_turn_off_registration(): void
    {
        $this->put(action('Admin\OptionController@registration'));
        $this->assertOptionHasValue('registration', 'on');
    }

    /**
     * Method helper
     *
     * @param string $option
     * @param string $value
     * @return bool
     */
    public function assertOptionHasValue(string $option, string $value)
    {
        $this->assertDatabaseHas('options', compact('option', 'value'));
    }
}
