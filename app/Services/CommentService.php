<?php


namespace App\Services;


use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentService
{
    /** Saves comment and returns json response
     * @param CommentRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CommentRequest $request, Post $post){
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->post_id = $post->id;
        $comment->user_id = Auth()->user()->id;

        return $this->jsonifyResponse(['model' => $comment, 'result' => $comment->save()]);
    }

    public function jsonifyResponse($toJsonify){
        return response(['comment' => $toJsonify['model'], 'result' => $toJsonify['result']]);
    }
}
