<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\Message;
use App\Services\PostService;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use App\Traits\PostTrait;

class HomeController extends Controller
{
    use PostTrait;
    use UserTrait;

    public function __construct(PostService $postService, \App\Services\NotificationService $notService)
    {
        $this->postService = $postService;
        $this->notificationService = $notService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = $this->postsAll();
        $firstStory = User::with('firstStory')->has('firstStory')->get()->take(5)->sortByDesc('firstStory.id');
        $users = $this->usersWithoutAuth();
        $countRequests = FriendRequest::where('receive_id',Auth()->user()->id)->where('accept',0)->count();
        $countMessages = Message::where('user_to',Auth()->user()->id)->where('status',0)->count();
        
        $messages = $this->notificationService->getMajorNotifications();
        return view ('welcome',compact('firstStory','users','countRequests','countMessages','posts', 'messages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
