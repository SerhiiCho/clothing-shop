<?php

namespace Tests\Feature\Models;

use App\Models\Visitor;
use Tests\TestCase;

class VisitorTest extends TestCase
{
    /** @test */
    public function visitor_model_has_attributes(): void
    {
        $this->assertClassHasAttribute('timestamps', Visitor::class);
    }
}
