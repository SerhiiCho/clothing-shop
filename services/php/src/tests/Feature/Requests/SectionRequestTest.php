<?php

namespace Tests\Feature\Requests;

use App\Models\Section;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SectionRequestTest extends TestCase
{
    use DatabaseTransactions;

    private $form_data;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->form_data = [
            'title' => str_random(10),
            'content' => str_random(10),
        ];
    }

    /**
     * @author Cho
     * @test
     */
    public function title_must_have_max_length(): void
    {
        $max = config('valid.section.title.max');

        $this->form_data['title'] = str_random($max + 1);
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * @author Cho
     * @test
     */
    public function content_must_have_max_length(): void
    {
        $max = config('valid.section.content.max');

        $this->form_data['content'] = str_random($max + 1);
        $this->makeRequestAndCheckDatabase();
    }

    /**
     * Method helper
     *
     * @return void
     */
    private function makeRequestAndCheckDatabase(): void
    {
        $this->put(action('Admin\SectionController@update', [
            'section' => factory(Section::class)->create()->id,
        ]), $this->form_data);

        $this->assertDatabaseMissing('sections', $this->form_data);
    }
}
