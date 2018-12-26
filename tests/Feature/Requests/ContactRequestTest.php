<?php

namespace Tests\Feature\Requests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ConractRequestTest extends TestCase
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
            'phone' => '(095) 777-77-' . rand(10, 99),
            'icon' => rand(1, 4),
        ];
    }
    /**
     * @author Cho
     * @test
     */
    public function icon_is_not_required(): void
    {
        $this->actingAs($this->admin)
            ->post(action('Admin\ContactController@store'), $this->form_data);

        $this->assertDatabaseHas('contacts', [
            'phone' => $this->form_data['phone'],
        ]);
    }

    /**
     * @author Cho
     * @test
     */
    public function icon_must_be_numeric(): void
    {
        $this->form_data['icon'] = 'text';

        $this->actingAs($this->admin)
            ->post(action('Admin\ContactController@store'), $this->form_data);

        $this->assertDatabaseMissing('contacts', [
            'phone' => $this->form_data['phone'],
        ]);
    }
}
