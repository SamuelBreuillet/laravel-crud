<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/posts', PostController::class .'@index')->name('posts.index');
Route::get('/posts/{post}', PostController::class .'@show')->name('posts.show');
Route::post('/posts', PostController::class .'@store')->name('posts.store');
Route::put('/posts/{post}', PostController::class .'@update')->name('posts.update');
Route::delete('/posts/{post}', PostController::class .'@destroy')->name('posts.destroy');