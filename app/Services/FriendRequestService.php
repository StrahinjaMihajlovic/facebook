<?php

namespace App\Services;

use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\Story;

class FriendRequestService
{
    /**
     * @param $id
     */
    public function send($id)
    {
        $request = new FriendRequest();
        $request->send_id = Auth()->user()->id;
        $request->receive_id = $id;
        $request->created_at = date('Y-m-d H:i:s');

        $request->save();
    }

    /**
     * @param $id
     */
    public function unsend($id)
    {
        FriendRequest::where('send_id', Auth()->user()->id)->where('receive_id', $id)->delete();
    }

    /**
     * @param $id
     */
    public function accept($id)
    {
        $accept = new Friend();
        $accept->auth_id = Auth()->user()->id;
        $accept->friend_id = $id;
        $accept->created_at = date('Y-m-d H:i:s');

        $accept->save();

        //delete record from table friend request
        FriendRequest::where('receive_id', Auth()->user()->id)->where('send_id', $id)->delete();
    }
}
