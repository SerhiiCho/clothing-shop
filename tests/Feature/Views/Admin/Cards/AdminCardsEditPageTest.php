<?php

namespace Tests\Feature\Views\Admin\Cards;

use App\Models\Card;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminCardsEditPageTest extends TestCase
{
    use DatabaseTransactions;

    private $card;
    private $url;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->card = factory(Card::class)->create();
        $this->url = "/admin/cards/{$this->card->id}/edit";
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get($this->url)
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest(): void
    {
        $this->get($this->url)->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get($this->url)
            ->assertOk()
            ->assertViewIs('admin.cards.edit');
    }
}
