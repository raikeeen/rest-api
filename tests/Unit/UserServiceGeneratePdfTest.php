<?php

namespace Tests\Unit;

use App\Mail\SendMailWithPdf;
use App\Models\User;
use App\Services\UserService;
use Barryvdh\DomPDF\PDF;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
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
        Mail::fake();

        $user = User::factory()->create()->first();

        app()->make(UserService::class)->sendFarewellMail($user);

        Mail::assertSent(SendMailWithPdf::class);
    }
}
