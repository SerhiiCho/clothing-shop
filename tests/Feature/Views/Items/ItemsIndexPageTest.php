<?php

namespace Tests\Feature\Views\Items;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ItemsIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_guest(): void
    {
        $this->get('/items')
            ->assertOk()
            ->assertViewIs('items.index');
    }
}
