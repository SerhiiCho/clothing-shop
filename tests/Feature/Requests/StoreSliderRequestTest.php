<?php

namespace Tests\Feature\Requests;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class StoreSliderRequestTest extends TestCase
{
    use DatabaseTransactions;

    private $form_data;
    private $admin;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->admin = factory(User::class)->state('admin')->create();
        $this->form_data = [
            'image' => UploadedFile::fake()->image('image.jpg'),
        ];
    }

    /**
     * @author Cho
     * @test
     */
    public function order_is_not_required(): void
    {
        $this->actingAs($this->admin)
            ->post(action('Admin\SliderController@store'), $this->form_data);

        $image = Slider::first()->value('image');

        $this->assertDatabaseHas('slider', compact('image'));

        if ($image !== 'default.jpg') {
            \Storage::delete("public/img/big/slider/{$image}");
        }
    }

    /**
     * @author Cho
     * @test
     */
    public function order_must_have_max_length(): void
    {
        $this->form_data['order'] = config('valid.slider.order.max') + 1;

        $this->actingAs($this->admin)
            ->post(action('Admin\SliderController@store'), $this->form_data);

        $this->assertNull(Slider::first());
    }
}
