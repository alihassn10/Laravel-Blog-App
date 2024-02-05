<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\userController;

//auth routes

Route::get('/',[userController::class,"showCorrectHomepage"]);
Route::post('/register',[userController::class,"register"])->middleware('guest');
Route::post('/login',[userController::class,"login"])->middleware('guest');
Route::post('/logout',[userController::class,"logout"])->middleware('mustLoggedIn');

//blog routes
Route::get('/create-post',[PostController::class,"showCreatePostForm"])->middleware('mustLoggedIn');
Route::post('/create-post',[PostController::class,"storePost"])->middleware('mustLoggedIn');
Route::get('/post/{post}',[PostController::class,"viewSinglePost"]);
Route::delete('/post/{post}',[PostController::class,"deletePost"])->middleware('can:delete,post');
Route::get('/post/{post}/edit',[PostController::class,"showEditForm"])->middleware('can:update,post');
Route::put('/post/{post}',[PostController::class,"updatePost"])->middleware('can:update,post');

//profile routes

Route::get('/profile/{user:username}',[PostController::class,"profile"]);

