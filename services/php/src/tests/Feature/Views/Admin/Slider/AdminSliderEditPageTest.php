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

    /**
     * @author Cho
     * @test
     */
    public function admin_can_update_slider(): void
    {
        $slider = factory(Slider::class)->create();
        $admin = factory(User::class)->state('admin')->create();

        $this->actingAs($admin)
            ->put(action('Admin\SliderController@update', ['id' => $slider->id]), [
                'order' => 11,
            ]);

        $this->assertDatabaseHas('slider', ['order' => 11]);
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_remove_slider(): void
    {
        $slider = factory(Slider::class)->create();
        $admin = factory(User::class)->state('admin')->create();

        $this->actingAs($admin)
            ->delete(action('Admin\SliderController@destroy', ['id' => $slider->id]));

        $this->assertDatabaseMissing('slider', ['id' => $slider->id]);
    }
}
