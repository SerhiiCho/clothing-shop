<?php

namespace Tests\Unit;

use Tests\TestCase;

class HelpersFunctionsTest extends TestCase
{
    /**
     * @author Cho
     * @test
     */
    public function active_if_route_is_helper_returns_active_string(): void
    {
        $this->get('/');
        $this->assertEquals('active', active_if_route_is('/'));

        $this->get('/items?category=women');
        $this->assertEquals('active', active_if_route_is('items', 'category', 'women'));

        $this->get('/items?category=men');
        $this->assertEquals('active', active_if_route_is('items', 'category', 'men'));
    }

    /**
     * @author Cho
     * @test
     */
    public function forget_all_cache_helper_removes_all_cache(): void
    {
        cache()->put('name', 'Serhii');
        cache()->put('color', 'Red');

        forget_all_cache();

        $this->assertFalse(cache()->has('name'));
        $this->assertFalse(cache()->has('color'));
    }
}
