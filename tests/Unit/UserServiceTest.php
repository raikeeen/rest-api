<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_method()
    {
        $data = [
            'email' => 'nick123f45479sd61165@gmail.com',
            'password' => '1234567890',
            'password_confirmation' => '1234567890',
        ];

        $userService = app()->make(UserService::class);
        $user = $userService->createUser($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', [
            'email' => 'nick123f45479sd61165@gmail.com'
        ]);
    }
}
