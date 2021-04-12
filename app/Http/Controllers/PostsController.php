<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(PostRequest $request){
        dd('die');
        $result = $this->postService->store($request);
        return redirect()->route('home@index', ['result' => $result]);
    }

}
