<?php

namespace Tests\Feature\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $order;
    private $admin;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->order = factory(Order::class)->create();
        $this->admin = factory(User::class)->state('admin')->create();
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
