<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
