<?php

namespace Tests\Feature\Views\Master\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MasterUsersIndexPageTest extends TestCase
{
    use DatabaseTransactions;

    private $master;

    /**
     * @author Cho
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->master = User::first();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessible_by_auth(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get('/master/users')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessible_by_guest(): void
    {
        $this->get('/master/users')->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_not_accessible_by_admin(): void
    {
        $admin = factory(User::class)->state('admin')->create();

        $this->actingAs($admin)
            ->get('/master/users')
            ->assertRedirect();
    }

    /**
     * @author Cho
     * @test
     */
    public function page_is_accessible_by_master(): void
    {
        $this->actingAs($this->master)
            ->get('/master/users')
            ->assertOk()
            ->assertViewIs('master.users.index');
    }

    /**
     * @author Cho
     * @test
     */
    public function master_can_see_all_users(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($this->master)
            ->get('/master/users')
            ->assertSeeText($user->name);
    }

    /**
     * @author Cho
     * @test
     */
    public function master_can_make_a_user_an_admin(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($this->master)
            ->put(action('Master\UserController@update', [
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
    public function master_can_remove_user(): void
    {
        $user = factory(User::class)->create();

        $this->actingAs($this->master)
            ->delete(action('Master\UserController@destroy', ['id' => $user->id]));

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /**
     * @author Cho
     * @test
     */
    public function admin_cant_remove_master(): void
    {
        $admin = factory(User::class)->state('admin')->create();

        $this->actingAs($admin)
            ->delete(action('Master\UserController@destroy', ['id' => 1]));
        $this->assertDatabaseHas('users', ['id' => 1]);
    }
}
