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

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/admin/orders')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest(): void
    {
        $this->get('/admin/orders')->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin/orders')
            ->assertOk()
            ->assertViewIs('admin.orders.index');
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_see_order_messages(): void
    {
        $order = factory(Order::class)->create();

        $this->actingAs($this->admin)
            ->get('/admin/orders')
            ->assertSeeText($order->phone);
    }
}
