<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewslaterMail extends Mailable
{
    public array $data;
    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: config('mail.from.address'),
            subject: $this->data['subject'] ?? "Deck-er Newsletter",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.newslater',
            with: [
                'subject' => $this->data['subject'] ?? "Deck-er Newsletter",
                'emailContent' => $this->data['message'],
                'email' => $this->data['email'],
                'settings' => Setting::first()
            ]
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

    public function failed(\Throwable $exception): void
    {
        Log::error($exception->getMessage());
    }
}
