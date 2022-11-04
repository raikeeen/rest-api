<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $user = User::factory()->create();

        $response = $this->json('POST', 'reset-password', ['email' => $user->email])->assertStatus(200);

        $response->assertJsonFragment([
            'message' => 'Mail has been sent successfully'
        ]);
    }
}
