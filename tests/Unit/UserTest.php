<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /** @test */
    public function userCanBeFoundByName()
    {
		$user = factory(User::class)->create(['name' => 'Kristina']);

		$this->browse(function ($browser) {
            $browser->visit('/dashboard')
                    ->assertSee($user->name);
        });
    }
}
