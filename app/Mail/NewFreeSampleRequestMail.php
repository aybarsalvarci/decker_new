<?php

namespace App\Mail;

use App\Models\FreeSample;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewFreeSampleRequestMail extends Mailable
{
    use SerializesModels;

    private FreeSample $freeSample;

    /**
     * Create a new message instance.
     */
    public function __construct(FreeSample $freeSample)
    {
        $this->freeSample = $freeSample;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Decker] New Free Sample Request',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.new-free-sample-request-mail',
            with: ['sample' => $this->freeSample],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
