<?php

namespace Tests\Feature\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $admin;
    private $order;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->admin = factory(User::class)->state('admin')->create();
        $this->order = factory(Order::class)->create([
            'user_id' => $this->admin->id,
        ]);
    }

    /**
     * @author Cho
     * @test
     */
    public function open_order_can_be_soft_deleted_by_admin(): void
    {
        $this->softDeleteOrder($this->order);

        $this->assertSoftDeleted('orders', [
            'id' => $this->order->id,
        ]);
    }

    /**
     * @author Cho
     * @test
     */
    public function open_order_cant_be_soft_deleted_by_admin_if_admin_hasnt_taken_this_order(): void
    {
        $order = factory(Order::class)->create();

        $this->softDeleteOrder($order);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'deleted_at' => null,
        ]);
    }

    /**
     * @author Cho
     * @test
     */
    public function open_order_cant_be_soft_deleted_by_guest(): void
    {
        $this->put(action('Admin\OrderController@softDelete', [
            'order' => $this->order->id,
        ]))->assertRedirect('/');
    }

    /**
     * @author Cho
     * @test
     */
    public function closed_order_can_be_force_deleted_by_admin(): void
    {
        $this->softDeleteOrder($this->order);

        $this->actingAs($this->admin)
            ->delete(action('Admin\OrderController@destroy', [
                'order' => $this->order->id,
            ]));

        $this->assertDatabaseMissing('orders', [
            'id' => $this->order->id,
        ]);
    }

    /**
     * @author Cho
     * @test
     */
    public function order_appears_in_db_after_guest_makes_successful_checkout_request(): void
    {
        $client_data = [
            'name' => string_random(5),
            'phone' => '3809' . rand(1000, 9999) . rand(1000, 9999),
        ];

        $this->withoutEvents();
        $this->post(action('CheckoutController@store'), $client_data);
        $this->assertDatabaseHas('orders', $client_data);
    }

    /**
     * Method helper
     *
     * @param \App\Models\Order $order
     * @return void
     */
    private function softDeleteOrder(Order $order): void
    {
        $this->actingAs($this->admin)
            ->put(action('Admin\OrderController@softDelete', [
                'order' => $order->id,
            ]));
    }
}
