<?php

namespace Tests\Feature\Views\Admin\Slider;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminSliderIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function page_is_not_accessible_by_guest(): void
    {
        $this->get('/admin/slider')
            ->assertRedirect();
    }

    /** @test */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/admin/slider')
            ->assertRedirect();
    }

    /** @test */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get('/admin/slider')
            ->assertOk()
            ->assertViewIs('admin.slider.index');
    }
}
