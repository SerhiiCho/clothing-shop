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
    private $url;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->contact = factory(Contact::class)->create();
        $this->url = "/admin/contacts/{$this->contact->id}/edit";
    }

    /* @test */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get($this->url)
            ->assertRedirect();
    }

    /* @test */
    public function page_is_not_accessible_by_guest(): void
    {
        $this->get($this->url)->assertRedirect();
    }

    /* @test */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get($this->url)
            ->assertOk()
            ->assertViewIs('admin.contacts.edit');
    }

    /* @test */
    public function admin_can_update_contact(): void
    {
        $contact = factory(Contact::class)->create();
        $admin = factory(User::class)->state('admin')->create();

        $this->actingAs($admin)
            ->put(action('Admin\ContactController@update', ['id' => $contact->id]), [
                'icon' => 5,
                'phone' => '380787656543',
            ]);

        $this->assertDatabaseHas('contacts', [
            'icon_id' => 5,
            'phone' => '380787656543',
        ]);
    }

    /* @test */
    public function admin_can_remove_contact(): void
    {
        $contact = factory(Contact::class)->create();
        $admin = factory(User::class)->state('admin')->create();

        $this->actingAs($admin)
            ->delete(action('Admin\ContactController@destroy', ['id' => $contact->id]));

        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }
}
