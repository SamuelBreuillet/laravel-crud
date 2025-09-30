<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/tokens', LoginController::class);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);

Route::group(['prefix' => '/', 'middleware' => ['auth:sanctum']], function () {
    Route::apiResource('posts', PostController::class)->except('index', 'show');
});
