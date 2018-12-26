<?php

namespace Tests\Feature\Views\Checkout;

use App\Events\RecivedOrderEvent;
use App\Models\User;
use Event;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CheckoutIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest_without_order(): void
    {
        $this->get('/checkout')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth_without_order(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/checkout')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_admin_without_order(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get('/checkout')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function client_can_make_checkout_post_request(): void
    {
        $this->withoutEvents();
        $this->assertDatabaseHas('orders', $this->clientMakesCheckoutPostRequest());
    }

    /**
     * @author Cho
     * @test
     */
    public function client_triggers_event_while_making_checkout_post_request(): void
    {
        Event::fake();
        $this->clientMakesCheckoutPostRequest();
        Event::assertDispatched(RecivedOrderEvent::class);
    }

    /**
     * Method helper
     *
     * @return array
     */
    private function clientMakesCheckoutPostRequest(): array
    {
        $this->post(action('CheckoutController@store'), $client_data = [
            'name' => str_random(5),
            'phone' => '3809' . rand(1000, 9999) . rand(1000, 9999),
        ]);

        return $client_data;
    }
}
