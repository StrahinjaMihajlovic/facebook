<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentNotification extends Notification
{
    use Queueable;

    public $message;
    public $comment;
    public $withEmail;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, Comment $comment, $withEmail = false)
    {
        $this->message = $message;
        $this->comment = $comment;
        $this->withEmail = $withEmail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->withEmail ? ['mail'] : ['database'];
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
                    ->greeting('Hi ' . $notifiable->name)
                    ->line('You have an unread notification:')
                    ->line($this->message)
                    ->action('View your notifications', url('/notification'));
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
            'message' => $this->message,
            'comment_id' => $this->comment->id
        ];
    }
}
