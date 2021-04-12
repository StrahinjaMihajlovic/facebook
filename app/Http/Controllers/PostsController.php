<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostsController extends Controller
{

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(PostRequest $request){
        $result = $this->postService->store($request);
        $posts = $this->postService->getAllPosts();
        return \view()->make('posts/partial_render', compact('posts'));
    }

    public function edit(Post $post){
        return \view()->make('posts/partial_edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post){
        return $this->postService->update($request, $post);
    }

    public function destroy(Post $post){
        $this->postService->destroy($post);
    }

}
