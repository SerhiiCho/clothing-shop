<?php

namespace Tests\Feature\Requests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CheckoutRequestTest extends TestCase
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
            'name' => string_random(7),
        ];
    }

    /**
     * @author Cho
     * @test
     */
    public function phone_must_have_min_length(): void
    {
        $phone_min = config('valid.checkout.phone.min');

        $this->form_data['phone'] = string_random($phone_min - 1);
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * @author Cho
     * @test
     */
    public function phone_must_have_max_length(): void
    {
        $phone_max = config('valid.checkout.phone.max');

        $this->form_data['phone'] = string_random($phone_max + 1);
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * @author Cho
     * @test
     */
    public function phone_is_required(): void
    {
        $this->form_data['phone'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * @author Cho
     * @test
     */
    public function name_is_required(): void
    {
        $this->form_data['name'] = '';
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * @author Cho
     * @test
     */
    public function name_must_have_min_length(): void
    {
        $name_min = config('valid.checkout.name.min');

        $this->form_data['name'] = string_random($name_min - 1);
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * @author Cho
     * @test
     */
    public function name_must_have_max_length(): void
    {
        $name_max = config('valid.checkout.name.max');

        $this->form_data['name'] = string_random($name_max + 1);
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * Method helper
     *
     * @return void
     */
    private function makeRequestAndCheckDatabase(): void
    {
        $this->post(action('CheckoutController@store'), $this->form_data);
        $this->assertDatabaseMissing('orders', $this->form_data);
    }
}
