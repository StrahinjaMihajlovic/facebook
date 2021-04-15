<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\Like;
use App\Services\LikeService;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct(LikeService $service)
    {
        $this->likeService = $service;
    }

    /** stores like event if it doesn't exists and deletes it otherwise
     * @param LikeRequest $request
     * @return bool|void
     */
    public function store(LikeRequest $request){
        if(Like::where(['post_id' => $request->post, 'user_id' => Auth::user()->id])->exists()){
            return  $this->likeService->jsonifyResponse($request, $this->likeService->dislike($request));
        }

        return  $this->likeService->jsonifyResponse($request, $this->likeService->like($request));
    }
}
