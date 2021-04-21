<?php

namespace Tests\Feature\Views\Items;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemsIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_guest(): void
    {
        $this->get('/items')
            ->assertOk()
            ->assertViewIs('items.index');
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/items')
            ->assertOk();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get('/items')
            ->assertOk();
    }
}
