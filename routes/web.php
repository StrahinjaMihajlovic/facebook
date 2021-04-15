<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function () {
    // home page
    Route::resource('/', HomeController::class);

    // lists all comments for the post
    Route::get('/post/{post}/comments', function(Post $post, CommentController $controller){
            return $controller->listForPost($post);
    });
    //stores new comments for the post
    Route::post('/post/{post}/comments', function(Post $post, CommentController $controller, CommentRequest  $request){
        return $controller->store($post, $request);
    });


    Route::resource('/post', PostsController::class);


    // route for users stories
    Route::resource('story',StoryController::class);
    Route::post('story/delete/{id}',[StoryController::class,'destroy'])->name('storyDelete');

    // routes for likes and dislikes
    Route::resource('like', \App\Http\Controllers\LikeController::class);

    //View for notification and route for send/unsend friend request
    Route::get('notification',[FriendRequestController::class,'home'])->name('notification');
    Route::post('request/{id}', [FriendRequestController::class,'request'])->name("request");
    //route for accept request
    Route::post('notification/accept/{id}',[FriendRequestController::class,'accept'])->name('accept');
    //route for delete friend
    Route::post('friend/delete/{id}',[FriendRequestController::class,'destroy'])->name('friend.destroy');
});


