<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function mark_all_as_read()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }
}
