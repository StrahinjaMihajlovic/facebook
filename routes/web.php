<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\StoryController;


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
    Route::resource('like', \App\Http\Controllers\LikeController::class);
});


