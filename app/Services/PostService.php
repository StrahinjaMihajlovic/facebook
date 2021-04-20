<?php


namespace App\Services;


use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function getAllPosts(){
        return Post::with(['user', 'pictures'])->where('public', 1)->orWhere('user_id', \auth()->user()->id)->orderByDesc('created_at')->get();
    }

    public function store($data){
        $post = new Post();
        $post->content = $data['message'];
        $post->public = boolval($data['public']);
        $post->user_id = Auth::user()->id;
        $post->save();
        return $post;
    }

    public function update( PostRequest $request, Post $post){
        $post->content = $request->message;
        $post->update();
    }

    /**
     * @throws \Exception
     */
    public function destroy(Post $post){
        if(isset($post->pictures->file)) {
            Storage::disk('images')->delete($post->pictures->file);
        }
        return $post->delete();
    }
}
