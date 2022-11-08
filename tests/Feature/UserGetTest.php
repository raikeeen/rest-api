<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserGetTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_users()
    {
        $user = User::factory()->create()->first();

        $this->json('GET', 'users')->assertUnauthorized();

        Passport::actingAs($user);

        $this->json('GET', 'users')->assertStatus(200)->assertJsonStructure(['users']);
    }
}
