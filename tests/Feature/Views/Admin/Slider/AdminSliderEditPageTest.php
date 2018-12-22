<?php

namespace Tests\Feature\Views\Admin\Slider;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminSliderEditPageTest extends TestCase
{
    use DatabaseTransactions;

    private $slider;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->slider = factory(Slider::class)->create();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get("/admin/slider/{$this->slider->id}/edit")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest(): void
    {
        $this->get("/admin/slider/{$this->slider->id}/edit")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get("/admin/slider/{$this->slider->id}/edit")
            ->assertOk()
            ->assertViewIs('admin.slider.edit');
    }
}
