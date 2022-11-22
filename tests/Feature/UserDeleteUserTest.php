<?php

namespace Tests\Feature;

use App\Mail\SendMailWithPdf;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserDeleteUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_user_request()
    {
        $user = User::factory()->count(5)->create()->first();

        $this->json('DELETE', 'users/'.$user->id)->assertUnauthorized();

        Passport::actingAs($user);

        Mail::fake();

        $response = $this->json('DELETE', 'users/'.$user->id)->assertStatus(200);
        $this->json('DELETE', 'users/2')->assertForbidden();

        Mail::assertSent(SendMailWithPdf::class);

        $this->assertDatabaseHas('users', [
            'status' => 2
        ]);

        $response->assertJsonFragment([
            'message' => 'Your account have been deleted!'
        ]);
    }
}
