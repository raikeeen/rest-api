<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserGetsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_user()
    {
        $user = User::factory()->count(5)->create()->first();

        Passport::actingAs($user);

        $this->json('GET', 'users/'.$user->id)->assertStatus(200);
        $this->json('GET', 'users/2')->assertForbidden();
        $this->json('GET', 'users/333')->assertNotFound();
    }
}
