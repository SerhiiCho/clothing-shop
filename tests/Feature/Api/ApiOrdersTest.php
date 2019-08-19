<?php

namespace Tests\Feature\Api;

use App\Models\Order;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OptionControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function see_open_orders_json(): void
    {
        $order = factory(Order::class)->create();

        $this->json('POST', '/api/orders/opened')
            ->assertStatus(200)
            ->assertJsonFragment(['phone' => $order->phone]);
    }

    /** @test */
    public function see_taken_orders_json(): void
    {
        $order = factory(Order::class)->state('taken')->create();

        $this->json('POST', '/api/orders/taken')
            ->assertStatus(200)
            ->assertJsonFragment(['phone' => $order->phone]);
    }

    /** @test */
    public function see_closed_orders_json(): void
    {
        $order = factory(Order::class)->create();
        $order->delete();

        $this->json('POST', '/api/orders/closed')
            ->assertStatus(200)
            ->assertJsonFragment(['phone' => $order->phone]);
    }
}
