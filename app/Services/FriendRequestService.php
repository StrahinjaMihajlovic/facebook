<?php

namespace App\Services;

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

    public function unsend($id)
    {
        FriendRequest::where('send_id', Auth()->user()->id)->where('receive_id', $id)->delete();
    }
}
