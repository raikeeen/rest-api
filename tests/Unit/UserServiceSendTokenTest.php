<?php

namespace Tests\Unit;

use App\Mail\ResetPassword;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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
        Mail::fake();

        $user = User::factory()->create();

        app()->make(UserService::class)->sendResetToken(['email' => $user->email]);

        Mail::assertSent(ResetPassword::class);

        $this->assertDatabaseHas('reset_password', [
            'token' => $user->resetPassword->token
        ]);
    }
}
