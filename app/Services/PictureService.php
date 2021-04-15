<?php


namespace App\Services;


use App\Http\Requests\PictureRequest;
use App\Models\Post;
use App\Models\PostPictures;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PictureService
{
    /**
     * @param PictureRequest $request
     * @param Post $post
     * @return bool
     */
    public function store(PictureRequest $request, Post $post){

        if(!$request->picture){
            return false;
        }

        $picture = new PostPictures();
        $location = Storage::disk('images')->put('images/posts', $request->picture);

        if(Storage::disk('images')->exists($location)){

            $picture->file = str_replace('images//posts//', '', $location);
            $picture->post_id = $post->id;

            return  $picture->save();;

        }
        else{
            return false;
        }
    }

    public function update(PictureRequest $request, Post $post){

        if(!$request->picture){
            return false;
        }

        if(isset($post->pictures)){
            $post->pictures->delete();
            Storage::disk('images')->delete($post->pictures->file);
        }


        return $this->store($request, $post);
    }
}
