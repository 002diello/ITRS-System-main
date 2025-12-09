<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// class RequestNotification extends Mailable
// {
//     use Queueable, SerializesModels;

//     public $requestForm;
//     public $status;
//     public $note;

//     public function __construct($requestForm, $status, $note = null)
//     {
//         $this->requestForm = $requestForm;
//         $this->status      = $status;
//         $this->note        = $note;
//     }

//     public function envelope(): Envelope
//     {
//         return new Envelope(
//             subject: '[ITRS]  ' . $this->requestForm->reference_number . ' – ' . ucfirst($this->status),
//         );
//     }

//     public function content(): Content
//     {
//         return new Content(
//             markdown: 'emails.request-notification',
//             with: [
//                 'requestForm' => $this->requestForm,
//                 'status'      => $this->status,
//                 'note'        => $this->note,
//             ]
//         );
//     }

//     public function attachments(): array
//     {
//         return [];
//     }
// }


class RequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $requestForm;
    public $status;
    public $note;

    public function __construct($requestForm, $status, $note = null)
    {
        $this->requestForm = $requestForm;
        $this->status = $status;
        $this->note = $note;
    }

    public function envelope(): Envelope
    {
        $subject = $this->getSubject();
        return new Envelope(
            subject: $subject,
        );
    }

    protected function getSubject(): string
    {
        $formTitle = $this->requestForm->form_title ?? 'Request';
        $reference = $this->requestForm->reference_number ?? '';

        switch ($this->status) {
            case 'new_request':
                return "[ITRS] New {$formTitle} Requires Approval - {$reference}";
            case 'pending_approval':
                return "[ITRS] Pending IT HOD Approval - {$reference}";
            case 'approved':
                return "[ITRS] Request Approved - {$reference}";
            case 'new_assignment':
                return "[ITRS] New Assignment - {$formTitle} - {$reference}";
            case 'assigned':
                return "[ITRS] Request Assigned - {$reference}";
            case 'completed':
                return "[ITRS] Request Completed - {$reference}";
            case 'rejected':
                return "[ITRS] Request Rejected - {$reference}";
            default:
                return "[ITRS] Update on your request - {$reference}";
        }
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.request-notification',
            with: [
                'requestForm' => $this->requestForm,
                'status' => $this->status,
                'note' => $this->note,
                'message' => $this->note, // Add this line to ensure message is available in the view
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}