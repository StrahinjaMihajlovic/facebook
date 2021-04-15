<?php

namespace App\Services;

use App\Models\Story;
use File;

class StoryService
{
    /**
     * @param $storyImage
     */
    public function store($storyImage)
    {
        $story = new Story();

        //get and move image to folder
        $imageName = time().'.'.$storyImage->getClientOriginalExtension();
        $storyImage->move(public_path('images/story'), $imageName);

        $story->image = $imageName;
        $story->user_id = Auth()->user()->id;
        $story->save();
    }

    /**
     * @param $id
     */
    public function accept($id)
    {
        FriendRequest::where('send_id',(integer)$id)->where('receive_id',Auth()->user()->id)->update(['accept'=>1]);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $story = Story::find($id);
        $image_path = public_path('/images/story/'.$story->image);

        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        $story->delete();
    }
}
