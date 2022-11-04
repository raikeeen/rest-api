<?php

namespace Tests\Feature;

use App\Models\ResetPassword;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserUpdatePasswordTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_password()
    {
        $user = User::factory()->has(ResetPassword::factory())->create();

        $password = fake()->password(8);

        $data = [
            'token' => $user->resetPassword->token,
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this->json('POST', 'new-password', $data)->assertStatus(200);

        if(!Hash::check($data['password'], $user->first()->password)) {
            $this->assertFalse(true);
        }

        $this->assertDatabaseMissing('reset_password', [
            'token' => $data['token'],
        ]);

        $response->assertJsonFragment([
            'message' => 'The password has been updated'
        ]);
    }
}
