<?php

namespace Tests\Feature\Views\Contacts;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContactsEditPageTest extends TestCase
{
    use DatabaseTransactions;

    private $contact;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->contact = factory(Contact::class)->create();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get("/contacts/{$this->contact->id}/edit")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest(): void
    {
        $this->get("/contacts/{$this->contact->id}/edit")
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get("/contacts/{$this->contact->id}/edit")
            ->assertOk()
            ->assertViewIs('contacts.edit');
    }
}
