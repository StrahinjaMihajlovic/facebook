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
    public function store($content, $parent_id = 0, Post $post){
        $comment = new Comment();
        $comment->content = $content;
        $comment->post_id = $post->id;

        if(Comment::find($parent_id)){
            $comment->parent_id = $parent_id;
        }
        $comment->user_id = Auth()->user()->id;

        return $this->jsonifyResponse(['model' => $comment, 'result' => $comment->save()]);
    }

    public function update($content, Comment $comment){
        $comment->content = $content;
        return $comment->update();
    }

    public function jsonifyResponse($toJsonify){
        return response(['comment' => $toJsonify['model'], 'result' => $toJsonify['result']]);
    }
}
