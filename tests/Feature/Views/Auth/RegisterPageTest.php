<?php

namespace Tests\Feature\Views\Auth;

use App\Models\Option;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterPageTest extends TestCase
{
    use DatabaseTransactions;

    private $url;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->url = '/' . config('custom.enter_slug') . '/register';
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_guest(): void
    {
        $this->get($this->url)
            ->assertOk()
            ->assertViewIs('auth.register');
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
    public function register_form_is_hidded_if_in_db_table_options_set_value_to_off(): void
    {
        $this->get($this->url)->assertSeeText(trans('forms.input_password'));
        Option::set('registration', 0);
        $this->get($this->url)->assertDontSeeText(trans('forms.input_password'));
    }
}
