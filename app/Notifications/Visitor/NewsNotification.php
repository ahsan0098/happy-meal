<?php

namespace App\Notifications\Visitor;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewsNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $message;
    private $subject;
    private $link;
    private $text;

    /**
     * Create a new notification instance.
     */
    public function __construct($subject, $message, $link = '', $text = '')
    {
        $this->message = $message;
        $this->subject = $subject;
        $this->link = $link;
        $this->text = $text;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $this->message;

        return (new MailMessage)
            ->from(config('site_general_email', env('MAIL_FROM_ADDRESS')), config('site_general_email', env('MAIL_FROM_NAME')))
            ->subject($this->subject)
            ->markdown('mail.template', ['message' => $this->message, 'link' => $this->link]);
    }

    /**
     * Get the database representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [];
    }
}
