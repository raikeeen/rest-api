<?php

namespace Tests\Feature;

use App\Mail\ResetPassword;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UserGetResetTokenTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_reset_token()
    {
        Mail::fake();

        $user = User::factory()->create();

        $response = $this->json('POST', 'reset-password', ['email' => $user->email])->assertStatus(200);

        Mail::assertSent(ResetPassword::class);

        $response->assertJsonFragment([
            'message' => 'Mail has been sent successfully'
        ]);
    }
}
