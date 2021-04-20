<?php

namespace App\Traits;

use App\Models\Post;

trait PostTrait {

    public function postsAll()
    {
        $posts = Post::with(['user', 'pictures'])->where('public', 1)->orWhere('user_id', \auth()->user()->id)->orderByDesc('created_at')->get();

        return $posts;
    }
}
