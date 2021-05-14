<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Http\Requests\MessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Test;
use App\Services\MessageService;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MesssageController extends Controller
{

    use UserTrait;

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
         // show only people which you have message
         // $users1 = User::with('senderConverastion')->has('senderConverastion')->get();
         // $users2 = User::with('recipientConverastion')->has('recipientConverastion')->get();
         // $users = $users1->merge($users2);

         // show all users from site
         $users = $this->usersWithoutAuth();

        return view('message',compact('users'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

    public function show($id)
    {
        return json_encode($this->messageService->show($id));
    }

    /**
     * @param MessageRequest $request
     */

    public function send(MessageRequest  $request)
    {
        $this->messageService->send($request->textMessage,$request->user_to);
    }

    /**
     * @param MessageRequest $request
     */
    public function read($id)
    {
       return $this->messageService->read($id);
    }

    /**
     * @param $id
     * @return mixed
     */

    public function destroy($id)
    {
        return $this->messageService->destroy($id);
    }

    public function pdfOfConversation(User $user){
        return $this->messageService->makePdfOfConversation($user);
    }

}
