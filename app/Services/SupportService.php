<?php

namespace App\Services;

use App\Events\NewMessage;
use App\Models\Support;
use Illuminate\Support\Facades\Auth;

class SupportService
{
    public function send($msg)
    {
        $support = new Support();
        $support->email = Auth()->user()->email;
        $support->message = $msg;
        $support->created_at = date('Y-m-d H:i:s');
        $support->save();

        event(new NewMessage($support));
    }
}
