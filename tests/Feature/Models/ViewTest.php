<?php

namespace Tests\Feature\Models;

use App\Models\View;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /** @test */
    public function view_model_has_attributes(): void
    {
        $this->assertClassHasAttribute('guarded', View::class);
        $this->assertClassHasAttribute('timestamps', View::class);
    }
}
