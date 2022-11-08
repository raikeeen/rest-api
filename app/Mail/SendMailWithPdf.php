<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMailWithPdf extends Mailable
{
    use Queueable, SerializesModels;
    public $pdf;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('mailtrap@example.com', 'Mailtrap'),
            subject: 'Delete account',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.users.delete',
            with: [

            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [Attachment::fromData(fn () => $this->pdf->output(), 'Report.pdf')
            ->withMime('application/pdf'),];
    }
}
