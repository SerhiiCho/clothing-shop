<?php

namespace Tests\Feature\Requests;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContactRequestTest extends TestCase
{
    use DatabaseTransactions;

    private $form_data;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->form_data = [
            'phone' => '(095) 777-77-' . rand(10, 99),
            'icon' => rand(1, 10),
        ];
    }
    /** @test */
    public function icon_is_not_required(): void
    {
        $this->form_data['icon'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function icon_must_be_numeric(): void
    {
        $this->form_data['icon'] = 'text';
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function icon_must_be_between_two_numbers(): void
    {
        $this->form_data['icon'] = config('valid.contact.icon.max') + 1;
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function phone_must_have_min_length(): void
    {
        $phone_min = config('valid.contact.phone.min');

        $this->form_data['phone'] = string_random($phone_min - 1);
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function phone_must_have_max_length(): void
    {
        $phone_max = config('valid.contact.phone.max');

        $this->form_data['phone'] = string_random($phone_max + 1);
        $this->makeRequestAndCheckDatabase();
    }

    /** @test */
    public function phone_is_required(): void
    {
        $this->form_data['phone'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * Method helper
     *
     * @return void
     */
    private function makeRequestAndCheckDatabase(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->post(action('Admin\ContactController@store'), $this->form_data);

        $this->assertDatabaseMissing('orders', [
            'phone' => $this->form_data['phone'],
        ]);
    }
}
