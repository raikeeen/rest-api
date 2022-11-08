<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserService;
use Barryvdh\DomPDF\PDF;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserServiceGeneratePdfTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_generate_pdf()
    {
        $user = User::factory()->create()->first();

        $pdf = app()->make(UserService::class)->generatePdf($user);

        $this->assertInstanceOf( PDF::class, $pdf);
    }
}
