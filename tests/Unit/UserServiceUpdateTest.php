<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_service_update()
    {
        $user = User::factory()->create();

        $data = [
            'email' => 'nick123f45479sd61165@gmail.com',
            'password' => '1234567890',
            'password_confirmation' => '1234567890',
        ];

        $updatedUser = app()->make(UserService::class)->updateUser($data, $user);

        if(!Hash::check($data['password'], $user->first()->password)) {
            $this->assertFalse(true);
        }

        $this->assertInstanceOf(User::class, $updatedUser);
        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ]);
    }
}
