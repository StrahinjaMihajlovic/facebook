<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MesssageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show only people which you have message
        $users1 = User::with('senderConverastion')->has('senderConverastion')->get();
        $users2 = User::with('recipientConverastion')->has('recipientConverastion')->get();

        $users = $users1->merge($users2);


        return view('message',compact('users'));
    }

    public function show($id)
    {
        //show only people which you have message
        $users1 = User::with('senderConverastion')->has('senderConverastion')->get();
        $users2 = User::with('recipientConverastion')->has('recipientConverastion')->get();

        $users = $users1->merge($users2);

        $userMessage = User::find($id);

        $messages = $userMessage->senderConverastion->merge($userMessage->recipientConverastion)->sortBy('created_at');

        return view('message',compact('users','messages'));
    }
}
