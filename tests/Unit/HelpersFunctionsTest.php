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

    /**
     * @author Cho
     * @test
     */
    public function visitor_id_function_returns_correct_data(): void
    {
        $expected = factory(\App\Models\Visitor::class)->create()->value('id');
        $this->assertEquals($expected, visitor_id());
    }

    /**
     * @author Cho
     * @test
     */
    public function no_connection_error_function_flashes_message_and_logs_given_error(): void
    {
        $exception = \Mockery::mock('Exception');
        $exception->shouldReceive('getMessage')->andReturn('Lorem');

        no_connection_error($exception, 'SomeFile');

        $this->assertFileExists(storage_path('logs/laravel-' . date('Y-m-d') . '.log'));
        $this->get('/')->assertSessionHas('error', trans('messages.query_error'));

        \File::delete(storage_path('logs/laravel-' . date('Y-m-d') . '.log'));
    }
}
