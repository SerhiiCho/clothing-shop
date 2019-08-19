<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Mockery;
use Tests\TestCase;
use App\Models\Visitor;

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
    public function forget_all_cache_helper_removes_all_cache_that_are_listed_in_cache_config(): void
    {
        cache()->put('home_cards', ['nice'], 5);
        cache()->put('orders', ['nice'], 5);

        forget_all_cache();

        $this->assertFalse(cache()->has('home_cards'));
        $this->assertFalse(cache()->has('orders'));
    }

    /**
     * @author Cho
     * @test
     */
    public function visitor_id_function_returns_correct_data(): void
    {
        $expected = factory(Visitor::class)->create()->value('id');
        $this->assertEquals($expected, visitor_id());
    }

    /**
     * @author Cho
     * @test
     */
    public function no_connection_error_function_flashes_message_and_logs_given_error(): void
    {
        $exception = Mockery::mock('Exception');
        $exception->shouldReceive('getMessage')->andReturn('Lorem');

        no_connection_error($exception, 'SomeFile');

        $this->assertFileExists(storage_path('logs/laravel-' . date('Y-m-d') . '.log'));
        $this->get('/')->assertSessionHas('error', trans('messages.query_error'));

        File::delete(storage_path('logs/laravel-' . date('Y-m-d') . '.log'));
    }

}
