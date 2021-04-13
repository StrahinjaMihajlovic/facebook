<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryRequest;
use App\Models\Story;
use Illuminate\Http\Request;
use App\Services\StoryService;

class StoryController extends Controller
{
    /**
     * @var StoryService
     */
    private $storyService;

    /**
     * StoryController constructor.
     * @param StoryService $storyService
     */
    public function __construct(StoryService $storyService)
    {
        $this->storyService = $storyService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        $this->storyService->store($request->storyImage);

        return back()->with('success','Success share story');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(Story $story)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(Story $story)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Story $story)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->storyService->destroy($id);

        return back();
    }
}
