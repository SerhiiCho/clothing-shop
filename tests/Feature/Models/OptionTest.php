<?php

namespace Tests\Feature\Models;

use App\Models\Option;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OptionTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @author Cho
     * @test
     */
    public function Set_method_returns_value_of_needed_option(): void
    {
        Option::set('registration', 'off');

        $this->assertDatabaseHas('options', [
            'option' => 'registration',
            'value' => 'off',
        ]);
    }

    /**
     * @author Cho
     * @test
     */
    public function Get_method_returns_value_of_needed_option(): void
    {
        $output = Option::get('registration');
        $this->assertEquals('on', $output);
    }
}
