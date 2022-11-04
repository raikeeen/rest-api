<?php

namespace Tests\Unit;

use App\Models\ResetPassword;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceUpdatePasswordTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_update_user_pass()
    {
        $user = User::factory()->has(ResetPassword::factory())->create();

        $data = [
            'token' => $user->resetPassword->token,
            'password' => fake()->password(8)
        ];

        app()->make(UserService::class)->updateUserPasswordAfterReset($data);

        if(!Hash::check($data['password'], $user->first()->password)) {
            $this->assertFalse(true);
        }

        $this->assertDatabaseMissing('reset_password', [
            'token' => $data['token'],
        ]);
    }
}
