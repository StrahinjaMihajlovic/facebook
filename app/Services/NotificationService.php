<?php


namespace App\Services;


use App\Models\Comment;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\CommentNotification;
use Bschmitt\Amqp\Facades\Amqp;

class NotificationService
{
    public function sendEmailsForUnreadNotifications()
    {
        $notifications = Notification::whereNull('read_at')->get();
        foreach ($notifications as $notification){
            $user = User::find($notification->notifiable_id);
            $user->notify(new CommentNotification($notification->data['message'], Comment::find($notification->data['comment_id']), true));
        }
    }
    
    public function getMajorNotifications(){
        $messages = [];
        Amqp::consume('major-notification', function ($message, $resolver) use(&$messages) {
    		
            
            array_push($messages, $message->body);
           // $resolver->acknowledge($message);
            
            $resolver->stopWhenProcessed();
            
           
        });
        return $messages; 
    }
}
