<?php


namespace App\Services;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeService
{
    public function store(Post $post){
        $like = new Like();
        $like->user_id = Auth::user()->id;
        $like->post_id = $post->id;
    }
}
