<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $requestForm;
    public $status;
    public $note;

    public function __construct($requestForm, $status, $note = null)
    {
        $this->requestForm = $requestForm;
        $this->status      = $status;
        $this->note        = $note;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[ITRS]  ' . $this->requestForm->reference_number . ' – ' . ucfirst($this->status),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.request-notification',
            with: [
                'requestForm' => $this->requestForm,
                'status'      => $this->status,
                'note'        => $this->note,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}