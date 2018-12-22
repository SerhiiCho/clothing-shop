<?php

namespace Tests\Feature\Views\Checkout;

use App\Models\User;
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
}
