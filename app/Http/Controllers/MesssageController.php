<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MesssageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get()->whereNotIn('id',Auth()->user()->id);

        return view('message',compact('users'));
    }

    public function show($id)
    {
        $users = User::get()->whereNotIn('id',Auth()->user()->id);

        $conversation = User::find($id);

        return view('message',compact('users','conversation'));
    }
}
