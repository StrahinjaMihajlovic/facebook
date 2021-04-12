<?php


namespace App\Services;


use App\Models\Post;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function getAllPosts(){
        return Post::all();
    }

    public function store(Request $request){
        $post = new Post();
        $post->content = $request->message;
        $post->user_id = Auth::user()->id;
        return  $post->save();
    }
}
