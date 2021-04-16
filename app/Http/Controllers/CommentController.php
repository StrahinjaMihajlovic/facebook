<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use App\Models\Comment;
use App\Models\Post;
class CommentController extends Controller
{
    public function __construct(CommentService $service){
        $this->service = $service;
        $this->authorizeResource(Comment::class, 'comment');
    }

    public function store(Post $post, CommentRequest $request){
        return $this->service->store($request, $post);
    }

    public function listForPost(Post $post){

        return \view()->make('comments/comments_partial', compact('post'));
    }

    public function destroy(Comment $comment){
        return $comment->delete();
    }

    public function edit(Comment $comment){
        return view()->make('comments.edit_comment', compact('comment'));
    }

    public function update(CommentRequest $request, Comment $comment){
        return $this->service->update($request, $comment);
    }

}
