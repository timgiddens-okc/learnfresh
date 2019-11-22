<?php

namespace App\Notifications;

use App\Checkpoint;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CheckpointAssigned extends Notification implements ShouldQueue
{
		protected $checkpoint;
	
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Checkpoint $checkpoint)
    {
        $this->checkpoint = $checkpoint;
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
        return (new MailMessage)
        						->subject('New Progress Checkpoint')
                    ->line('Please complete a checkpoint! We\'d love to know how your progress is going.')
                    ->action('Complete Checkpoint', url('/checkpoint/version/' . $this->checkpoint->version))
                    ->line('Thank you for being a valued member of our community!');
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
