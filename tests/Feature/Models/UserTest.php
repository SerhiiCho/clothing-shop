<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function method_IsAdmin_returns_true_if_admin_column_is_set_to_1(): void
    {
        $user = factory(User::class)->create(['admin' => 1]);
        $this->assertTrue($user->isAdmin());
    }

    /** @test */
    public function method_IsAdmin_returns_false_if_admin_column_is_set_to_0(): void
    {
        $user = factory(User::class)->create(['admin' => 0]);
        $this->assertFalse($user->isAdmin());
    }

    /** @test */
    public function method_IsMaster_returns_true_if_id_column_is_set_to_1(): void
    {
        $this->assertTrue(User::first()->isMaster());
    }

    /** @test */
    public function method_IsMaster_returns_false_if_id_column_is_not_set_to_0(): void
    {
        $user = factory(User::class)->create();
        $this->assertFalse($user->isMaster());
    }
}
