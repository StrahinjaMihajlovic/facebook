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
        $notifications = FriendRequest::get();
        return view('notification',compact('notifications'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send ($id)
    {
        $this->friendRequestService->send($id);

        return back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unsend ($id)
    {
        $this->friendRequestService->unsend($id);

        return back();
    }
}
