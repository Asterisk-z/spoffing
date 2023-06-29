<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlertOnNewDomain extends Notification
{
    use Queueable;

    public $user;
    public $domain;
    public $List;

    /**
     * Create a new notification instance.
     */
    public function __construct($domain, $List)
    {
        $this->domain = $domain;
        $this->List = $List;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Hello')
            ->line('You have a new domain similar to one of your' . $this->domain)
            ->line(implode($this->List))
            ->line('Login to see details')
            // ->line('Hello')
            ->action('Login', url('/'));
        // ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
