<?php

namespace Tests\Feature\Views\Admin\Contacts;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminContactsCreatePageTest extends TestCase
{
    use DatabaseTransactions;

    private $url;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->url = '/admin/contacts/create';
    }

    /** @test */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get($this->url)
            ->assertRedirect();
    }

    /** @test */
    public function page_is_not_accessible_by_guest(): void
    {
        $this->get($this->url)->assertRedirect();
    }

    /** @test */
    public function page_is_accessible_by_admin(): void
    {
        $this->actingAs(factory(User::class)->state('admin')->create())
            ->get($this->url)
            ->assertOk()
            ->assertViewIs('admin.contacts.create');
    }

    /** @test */
    public function admin_can_add_new_contact(): void
    {
        $form_data = ['phone' => '(095) 777-77-' . rand(10, 99)];

        $this->actingAs(factory(User::class)->state('admin')->create())
            ->post(action('Admin\ContactController@store'), $form_data);

        $this->assertDatabaseHas('contacts', $form_data);
    }
}
