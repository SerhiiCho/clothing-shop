<?php

namespace Tests\Feature\Views\Admin\Dashboard;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminDashboardIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/admin/dashboard')
            ->assertRedirect();
    }

    /** @test */
    public function page_is_not_accessible_by_guest(): void
    {
        $this->get('/admin/dashboard')
            ->assertRedirect();
    }

    /** @test */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get('/admin/dashboard')
            ->assertOk()
            ->assertViewIs('admin.dashboard.index');
    }
}
