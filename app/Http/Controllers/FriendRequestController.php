<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FriendRequestService;

class FriendRequestController extends Controller
{
    /**
     * @var FriendRequestService
     */
    private $friendRequestService;

    /**
     * FriendRequestController constructor.
     * @param FriendRequestService $friendRequestService
     */
    public function __construct(FriendRequestService $friendRequestService)
    {
        $this->friendRequestService = $friendRequestService;
    }

    public function home()
    {
        $notifications = FriendRequest::where('receive_id',Auth()->user()->id)->get();
        return view('notification',compact('notifications'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function request ($id)
    {
       $user = User::find($id);

        if($user->ifReceiveRequest) {
            $this->friendRequestService->accept($id);
        } elseif($user->ifSendRequest) {
           $this->friendRequestService->unsend($id);
       } else{
           $this->friendRequestService->send($id);
       }

       return back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->friendRequestService->destroy($id);

        return back();
    }
}
