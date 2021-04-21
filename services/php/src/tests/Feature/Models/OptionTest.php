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
    public function Set_method_sets_value_of_needed_option(): void
    {
        Option::set('registration', 0);

        $this->assertDatabaseHas('options', [
            'option' => 'registration',
            'value' => 0,
        ]);
    }
}
