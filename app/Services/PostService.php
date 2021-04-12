<?php


namespace App\Services;


use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getAllPosts(){
        return Post::with('user')->orderByDesc('created_at')->get();
    }

    public function store(PostRequest $request){
        $post = new Post();
        $post->content = $request->input('message');
        $post->user_id = Auth::user()->id;
        return  $post->save();
    }

    public function update( PostRequest $request, Post $post){
        $post->content = $request->message;
        $post->update();
    }
}
