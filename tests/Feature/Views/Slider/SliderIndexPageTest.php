<?php

namespace Tests\Feature\Views\Slider;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SliderIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest(): void
    {
        $this->get('/admin/slider')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/admin/slider')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get('/admin/slider')
            ->assertOk()
            ->assertViewIs('admin.slider.index');
    }
}
