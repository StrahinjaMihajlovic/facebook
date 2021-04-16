<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public function send($textMessage,$user_to)
    {
            $message = new Message();
            $message->user_from = Auth()->user()->id;
            $message->user_to = $user_to;
            $message->message = $textMessage;
            $message->created_at = date('Y-m-d H:i:s');
            $message->status = 0;

            $message->save();
    }
}
