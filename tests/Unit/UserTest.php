<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function userCanBeFoundByName()
    {
        $user = factory(User::class)->create(['name' => 'John']);
        $this->assertDatabaseHas('users', ['name' => 'John']);
    }
}
