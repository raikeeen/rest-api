<?php

namespace Tests\Unit;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserServiceSendTokenTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_send_token()
    {
        $user = User::factory()->create();

        app()->make(UserService::class)->sendResetToken(['email' => $user->email]);

        $this->assertDatabaseHas('reset_password', [
            'token' => $user->resetPassword->token
        ]);
    }
}
