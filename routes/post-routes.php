<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::prefix('admin')->group(function () {
    Route::middleware('auth:api')->group(function () {
            Route::middleware('checkIfAdmin')->group(function () {
            Route::get('/posts', [PostController::class, 'index']);
            Route::get('/posts/{id}', [PostController::class, 'show']);
            Route::post('/posts', [PostController::class, 'store']);
            Route::put('/posts/{id}', [PostController::class, 'update']);
            Route::delete('/posts/{id}', [PostController::class, 'destroy']);
        });
    });
});
