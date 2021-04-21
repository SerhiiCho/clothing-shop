<?php

namespace Tests\Feature\Controllers;

use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SectionControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $admin;
    private $section;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->admin = factory(User::class)->state('admin')->create();
        $this->section = factory(Section::class)->create();
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_edit_section(): void
    {
        $form_data = [
            'title' => str_random(10),
            'content' => str_random(10),
        ];

        $this->actingAs($this->admin)
            ->put(action('Admin\SectionController@update', [
                'section' => $this->section->id,
            ]), $form_data);

        $this->assertDatabaseHas('sections', $form_data);
    }
}
