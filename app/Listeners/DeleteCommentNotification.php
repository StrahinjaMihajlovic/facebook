<?php

namespace App\Listeners;

use App\Events\CommentDeleting;
use App\Models\Notification;
use App\Notifications\CommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteCommentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentDeleting  $event
     * @return void
     */
    public function handle(CommentDeleting $event)
    {
        $notifications = Notification::where('data->comment_id', $event->comment->id)->get();
        $notifications->each(function($item){
            $item->delete();
        });
        $subcomments = $event->comment->subcomments;
        foreach ($subcomments as $subcomment){
            $subcomment->delete();
        }
    }
}
