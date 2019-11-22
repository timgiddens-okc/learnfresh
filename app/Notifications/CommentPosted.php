<?php

namespace App\Notifications;

use App\Comment;
use App\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentPosted extends Notification implements ShouldQueue
{
    use Queueable;
    
    protected $comment;
    protected $topic;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->topic = $comment->topic;
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
        						->subject('A New Comment Has Been Posted')
                    ->line('A new comment has been posted in "' . $this->topic->title . '"')
                    ->line('"' .  nl2br(strip_tags($this->comment->comment)) .  '"')
                    ->action('View The Post', url('/community/' . $this->topic->slug))
                    ->line('Thank you for being a part of LFCA!');
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
