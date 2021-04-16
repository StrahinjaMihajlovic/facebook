<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MesssageController extends Controller
{
    /**
     * @var
     */
    private $messageService;

    /**
     * MesssageController constructor.
     * @param MessageService $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

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

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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

    public function send(MessageRequest  $request)
    {
        $this->messageService->send($request->textMessage,$request->user_to);
    }

}
