<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_registration()
    {
        $this->artisan('passport:install');

        $data = [
            'email' => 'nick12ds34sd544f676768@gmail.com',
            'password' => '1234567890',
            'password_confirmation' => '1234567890',
        ];

        $response = $this->json('POST', 'users', $data)->assertStatus(201);
        $response->assertJsonStructure([
            'token'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'nick12ds34sd544f676768@gmail.com'
        ]);
    }
}
