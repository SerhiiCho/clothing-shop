<?php

namespace Tests\Feature\Views\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminUsersIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    private $admin;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->admin = factory(User::class)->state('admin')->create();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/admin/users')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessable_by_guest(): void
    {
        $this->get('/admin/users')->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessable_by_admin(): void
    {
        $this->actingAs($this->admin)
            ->get('/admin/users')
            ->assertOk()
            ->assertViewIs('admin.users.index');
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_see_all_users(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($this->admin)
            ->get('/admin/users')
            ->assertSeeText($user->name);
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_make_a_user_an_admin(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($this->admin)
            ->put(action('Admin\UserController@update', [
                'user' => $user->id,
            ]));

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'admin' => 1,
        ]);
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_can_remove_user(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($this->admin)
            ->delete(action('Admin\UserController@destroy', ['id' => $user->id]));

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_cant_remove_first_admin(): void
    {
        $other_admin = factory(User::class)->state('admin')->create();

        if (User::whereId(1)->doesntExist()) {
            factory(User::class)->state('admin')->create(['id' => 1]);
        }

        $this->actingAs($other_admin)
            ->delete(action('Admin\UserController@destroy', ['id' => 1]));
        $this->assertDatabaseHas('users', ['id' => 1]);
    }
}
