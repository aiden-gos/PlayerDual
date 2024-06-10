<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentNotify extends Notification
{
    use Queueable;
    private $user_id;
    private $username;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user_id, $username)
    {
        $this->user_id = $user_id;
        $this->username = $username;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/user/'.$this->user_id);
        return (new MailMessage)
            ->greeting('Rent player')
            ->line('You have been rented by ' . $this->username)
            ->action('View', $url)
            ->line('Thank you for using our application');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
