<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function admin_can_logout(): void
    {
        $admin = factory(User::class)->state('admin')->create();

        $this->actingAs($admin)->post(route('logout'))->assertRedirect('/');
    }
}
