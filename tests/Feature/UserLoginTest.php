<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_login()
    {
        $this->artisan('passport:install');

        $data = [
            'email' => 'nikita1@gmail.com',
            'password' => '1234567890',
        ];

        app()->make(UserService::class)->createUser($data);

        $response = $this->json('POST', 'login', $data)->assertStatus(200);

        $response->assertJsonStructure([
            'token'
        ]);
    }
}
