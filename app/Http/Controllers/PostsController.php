<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Http\Requests\PostEditRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Providers\RouteServiceProvider;
use App\Services\PictureService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
class PostsController extends Controller
{

    public function __construct(PostService $postService, PictureService $pictureService)
    {
        $this->postService = $postService;
        $this->pictureService = $pictureService;
    }


    /**
     * @param PostRequest $request
     * @param PictureRequest $picRequest
     * @return \Illuminate\Contracts\View\View|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(PostRequest $request, PictureRequest $picRequest){

        $post = $this->postService->store($request);
        $this->pictureService->store($picRequest, $post);

        $posts = $this->postService->getAllPosts();

        return \view()->make('posts/partial_render', compact('posts'));
    }


    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\View|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit(Post $post){

        if ( !Gate::allows('edit_post', $post)) {
            abort(403);
        }

        return \view()->make('posts/partial_edit', compact('post'));
    }


    /**
     * @param PostRequest $request
     * @param Post $post
     */
    public function update(PostRequest $request, Post $post){
        if ( !Gate::allows('edit_post', $post)) {
            abort(403);
        }

        return $this->postService->update($request, $post);
    }

    /**
     * @throws \Exception
     */
    public function destroy(Post $post){
        if ( !Gate::allows('delete_post', $post)) {
            abort(403, 'You are not allowed to delete this post');
        }
        return ($this->postService->destroy($post));
    }

}
