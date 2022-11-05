<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class UserUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_user_data()
    {
        User::factory()->count(5)->create();
        $users = User::all();

        $password = fake()->password(8);

        $data = [
            'email' => fake()->unique()->safeEmail(),
            'password' => $password,
            'password_confirmation' => $password
        ];

        $nonAuthUser = $users->get(1);

        //non-auth user is trying to update his data
        $this->json('PUT', 'users/'.$nonAuthUser->id, $data)->assertUnauthorized();

        //authenticated user is trying to update his data
        $authUser = $users->first();

        Passport::actingAs($authUser);

        $this->json('PUT', 'users/'.$authUser->id, $data)->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => $data['email']
        ]);

        //authenticated user is trying to update another user's details
        $this->json('PUT', 'users/'.$nonAuthUser->id, $data)->assertForbidden();

    }
}
