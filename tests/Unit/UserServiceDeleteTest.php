<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceDeleteTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_delete_user()
    {
        $user = User::factory()->create()->first();

        app()->make(UserService::class)->deleteUser($user);

        $this->assertDatabaseHas('users', [
            'status' => 2
        ]);
    }
}
