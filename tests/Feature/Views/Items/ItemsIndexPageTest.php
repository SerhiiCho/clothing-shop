<?php

namespace Tests\Feature\Views\Items;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemsIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /* @test */
    public function page_is_accessible_by_guest(): void
    {
        $this->get('/items')
            ->assertOk()
            ->assertViewIs('items.index');
    }

    /* @test */
    public function page_is_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/items')
            ->assertOk();
    }

    /* @test */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get('/items')
            ->assertOk();
    }
}
