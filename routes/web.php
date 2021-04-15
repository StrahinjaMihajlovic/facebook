<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\MesssageController;


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

    //route for messagin system
    Route::get('message',[MesssageController::class,'index'])->name('message.index');
    Route::get('message/{id}',[MesssageController::class,'show'])->name('message.show');
});


