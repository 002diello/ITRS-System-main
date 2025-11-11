<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestStatusUpdated extends Notification
{
    use Queueable;

    protected $requestForm;
    protected $status;
    protected $message;

    public function __construct($requestForm, $status, $message = null)
    {
        $this->requestForm = $requestForm;
        $this->status = $status;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $subject = "Request #{$this->requestForm->id} - " . ucfirst($this->status);
        
        $mail = (new MailMessage)
            ->subject($subject)
            ->line("Your request #{$this->requestForm->id} has been {$this->status}.")
            ->line("Request Type: {$this->requestForm->form_code}")
            ->line("Status: " . ucfirst($this->status));

        if ($this->status === 'rejected' && $this->message) {
            $mail->line("Reason: {$this->message}");
        }

        $mail->action('View Request', url("/requests/{$this->requestForm->id}"))
            ->line('Thank you for using our application!');

        return $mail;
    }
}
