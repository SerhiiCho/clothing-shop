<?php

namespace Tests\Feature\Views\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RegisterPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_guest(): void
    {
        $this->get('/' . config('custom.enter_slug') . '/register')
            ->assertOk()
            ->assertViewIs('auth.register');
    }
}
