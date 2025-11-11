<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $status;
    public $message;
    public $recipientRole;

    public function __construct($request, $status, $message = null, $recipientRole = 'requester')
    {
        $this->request = $request;
        $this->status = $status;
        $this->message = $message;
        $this->recipientRole = $recipientRole;
    }

    public function build()
    {
        $subject = "[ITRS] " . ucfirst($this->status) . " - Request #{$this->request->id} - {$this->request->form_code}";
        
        return $this->subject($subject)
                    ->view('emails.request-notification')
                    ->with([
                        'request' => $this->request,
                        'status' => $this->status,
                        'message' => $this->message,
                        'recipientRole' => $this->recipientRole,
                        'subject' => $subject
                    ]);
    }
}