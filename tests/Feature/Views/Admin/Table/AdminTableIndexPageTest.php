<?php

namespace Tests\Feature\Views\Admin\Slider;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminTableIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessible_by_guest(): void
    {
        $this->get('/admin/table')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/admin/table')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get('/admin/table')
            ->assertOk()
            ->assertViewIs('admin.table.index');
    }
}
