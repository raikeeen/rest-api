<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceGetUsersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_users()
    {
        User::factory()->count(5)->create();

        $users = app()->make(UserService::class)->getUsers();

        $this->assertInstanceOf(Collection::class, $users);
    }
}
