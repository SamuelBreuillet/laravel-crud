<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/tokens', LoginController::class);
Route::get('/posts', [PostController::class, 'index']);

Route::group(['prefix' => '/', 'middleware' => ['auth:sanctum']], function () {
    Route::apiResource('posts', PostController::class)->except('index');
    Route::apiResource('users', UserController::class);
});
