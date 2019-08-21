<?php

namespace Tests\Feature\Views\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function page_is_accessible_by_guest(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertViewIs('auth.login');
    }

    /** @test */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/login')
            ->assertRedirect();
    }
}
