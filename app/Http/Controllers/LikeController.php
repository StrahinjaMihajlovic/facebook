<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    public function store(LikeRequest $request, Post $post){

    }
}
