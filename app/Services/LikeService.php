<?php


namespace App\Services;
use App\Http\Requests\LikeRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class LikeService
{

    public function dislike(LikeRequest $request){
        try {
            $exists = Like::where(['post_id' => $request->post, 'user_id' => Auth::user()->id])->firstOrFail();
            return $exists->delete();
        }catch (ModelNotFoundException $e) {
            return abort(404);
        }
    }
    /** stores the like event if the post is not already liked and deletes if it is.
     * @param LikeRequest $request
     * @return bool
     */
    public function like(LikeRequest $request)
    {
            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->post_id = $request->post;
            $test = Post::find($like->post_id);
            return $like->logInteractionAndSave([Post::find($like->post_id)->user]);
    }

    /** creates the json response for front - end like/dislike implementation
     * @param LikeRequest $request
     * @param bool $result
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonifyResponse(LikeRequest $request, bool $result){
        return response()->json(['likes_count' => count(Post::find($request->post())->first()->likes), 'result' => $result]);
    }
}
