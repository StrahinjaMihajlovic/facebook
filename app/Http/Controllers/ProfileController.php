<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $posts = Post::get()->where('user_id',Auth()->user()->id);

        return view('profile',compact('posts'));
    }
}
