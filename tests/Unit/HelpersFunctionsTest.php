<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Mockery;
use Tests\TestCase;
use App\Models\Visitor;

class HelpersFunctionsTest extends TestCase
{
    /** @test */
    public function active_if_route_is_helper_returns_active_string(): void
    {
        $this->get('/');
        $this->assertEquals('active', active_if_route_is('/'));

        $this->get('/items?category=category2');
        $this->assertEquals('active', active_if_route_is('items', 'category', 'category2'));

        $this->get('/items?category=category1');
        $this->assertEquals('active', active_if_route_is('items', 'category', 'category1'));
    }

    /** @test */
    public function forget_all_cache_helper_removes_all_cache_that_are_listed_in_cache_config(): void
    {
        cache()->put('home_cards', ['nice'], 5);
        cache()->put('orders', ['nice'], 5);

        forget_all_cache();

        $this->assertFalse(cache()->has('home_cards'));
        $this->assertFalse(cache()->has('orders'));
    }

    /** @test */
    public function visitor_id_function_returns_correct_data(): void
    {
        $expected = factory(Visitor::class)->create()->value('id');
        $this->assertEquals($expected, visitor_id());
    }

    /** @test */
    public function no_connection_error_function_flashes_message_and_logs_given_error(): void
    {
        $exception = Mockery::mock('Exception');
        $exception->shouldReceive('getMessage')->andReturn('Lorem');

        no_connection_error($exception, 'SomeFile');

        $this->assertFileExists(storage_path('logs/laravel-' . date('Y-m-d') . '.log'));
        $this->get('/')->assertSessionHas('error', trans('messages.query_error'));

        File::delete(storage_path('logs/laravel-' . date('Y-m-d') . '.log'));
    }

    /** @test */
    public function get_current_category_returns_string_category2_if_request_url_contains_this_word(): void
    {
        $this->assertSame('category2', get_current_category('http://some-url/nice/category2/'));
        $this->assertSame('category2', get_current_category('http://some-url/category2/nice/'));
        $this->assertSame('category2', get_current_category('https://category2/nice/hello/'));
        $this->assertSame('category2', get_current_category('https://nicecategory2/nice/hello/'));
    }

    /** @test */
    public function get_current_category_returns_string_category1_if_request_url_contains_this_word(): void
    {
        $this->assertSame('category1', get_current_category('http://some-url/nice/category1/'));
        $this->assertSame('category1', get_current_category('http://some-url/category1/nice/'));
        $this->assertSame('category1', get_current_category('https://category1/nice/hello/'));
        $this->assertSame('category1', get_current_category('https://nicecategory1/nice/hello/'));
    }

    /** @test */
    public function get_current_category_returns_null_if_request_url_is_not_containing_first_or_second(): void
    {
        $this->assertNull(get_current_category('http://some-url/nice/meddnnn/'));
        $this->assertNull(get_current_category('http://some-url/nicmnen/nwoice/'));
    }

    /** @test */
    public function get_file_name_returns_string(): void
    {
        $this->assertTrue(is_string(get_file_name('Nice', 'png')));
    }

    /** @test */
    public function get_file_name_returns_image_name_slug_based_on_given_params(): void
    {
        $this->assertTrue((bool) preg_match('/nice-[\w]{7}+.png/', get_file_name('Nice', 'png')));
        $this->assertTrue((bool) preg_match('/cool-dd-[\w]{7}+.jpg/', get_file_name('CooL dd', 'jpg')));
        $this->assertTrue((bool) preg_match('/hello-man-[\w]{7}+.png/', get_file_name('Hello man', 'png')));
    }

    /** @test */
    public function string_random_returns_string(): void
    {
        $this->assertTrue(is_string(string_random()));
    }

    /** @test */
    public function string_random_returns_string_with_given_chars_length_if_you_pass_the_number(): void
    {
        $this->assertEquals(10, strlen(string_random(10)));
        $this->assertEquals(0, strlen(string_random(0)));
        $this->assertEquals(33, strlen(string_random(33)));
        $this->assertEquals(12, strlen(string_random(12)));
    }
}
