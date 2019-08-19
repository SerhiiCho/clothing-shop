<?php

namespace Tests\Feature\Views\Pages;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PagesHomePageTest extends TestCase
{
    use DatabaseTransactions;

    /* @test */
    public function page_is_accessible_by_guest(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertViewIs('pages.home');
    }
}
