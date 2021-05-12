<?php

namespace App\Services;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\App;
use function GuzzleHttp\json_encode;
use function PHPUnit\Framework\isJson;

class MessageService
{
    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $userMessage = User::find($id);

        $messages = $userMessage->senderConverastion->merge($userMessage->recipientConverastion)->sortBy('created_at');

        $listMessage = array();
        foreach ( $messages as $message ) {
            $listMessage[] = array(
                'id'   => $message->id,
                'user_from' => $message->user_from,
                'user_to' => $message->user_to,
                'message' => $message->message,
                'status' => $message->status,
                'created_at' => $message->created_at
            );
        }
        return $listMessage;
    }
    /**
     * @param $textMessage
     * @param $user_to
     */
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

    /**
     * @param $id
     */
    public function read($id)
    {
        $userMessage = User::find($id);

        $messages = $userMessage->readMessage->pluck('id');

        Message::whereIn('id',$messages)->update(['status'=>1]);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
    }

    public function makePdfOfConversation($user){
        $authUser = Auth()->user();
        $messages = Message::whereIn('user_from', [$authUser->id, $user->id])
            ->whereIn('user_to', [$authUser->id, $user->id])->orderBy('created_at')->take(10)->get();
        $pdf = App::make('dompdf.wrapper');
        $html = "<h1>This is your conversation with the user '$user->name'</h1>";
        $html .= '<style>
            .subheaderspace{
                margin-top:20px;
            }
            .border{
                border:solid lightgray 2px;
            }
        </style>';
        foreach ($messages as $message){
            $sender = $message->user_from === $user->id ? $user->name : $authUser->name;
            $html .= "<p>Sent by: $sender</p> at $message->created_at";
            $html .= "<h4 class='subheaderspace'>With message:</h4>";
            $html .= "<p class='border'>$message->message</p>";
        }
        $pdf->loadHTML($html);
        return $pdf->stream();
    }

}
