<?php

namespace App\Services;

use App\Models\Story;

class StoryService
{
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
}
