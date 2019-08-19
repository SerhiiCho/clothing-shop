<?php

namespace Tests\Feature\Views\Admin\Orders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminOrdersIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    private $admin;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->admin = factory(User::class)->state('admin')->create();
    }

    /** @test */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/admin/orders')
            ->assertRedirect();
    }

    /** @test */
    public function page_is_not_accessible_by_guest(): void
    {
        $this->get('/admin/orders')->assertRedirect();
    }

    /** @test */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin/orders')
            ->assertOk()
            ->assertViewIs('admin.orders.index');
    }

    /** @test */
    public function admin_can_take_order(): void
    {
        $order = factory(Order::class)->create();

        $this->actingAs($this->admin)
            ->post(action('Admin\OrderController@store', [
                'order' => $order->id,
            ]));

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'user_id' => $this->admin->id,
        ]);
    }

    /** @test */
    public function admin_cant_take_order_if_other_admin_took_it(): void
    {
        $other_admin = factory(User::class)->state('admin')->create();
        $order = factory(Order::class)->create([
            'user_id' => $other_admin->id,
        ]);

        $this->actingAs($this->admin)
            ->post(action('Admin\OrderController@store', [
                'order' => $order->id,
            ]));

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'user_id' => $other_admin->id,
        ]);
    }

    /** @test */
    public function admin_can_untake_order(): void
    {
        $order = factory(Order::class)->create([
            'user_id' => $this->admin->id,
        ]);

        $this->actingAs($this->admin)
            ->post(action('Admin\OrderController@store', [
                'order' => $order->id,
            ]));

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'user_id' => null,
        ]);
    }
}
