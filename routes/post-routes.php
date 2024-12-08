<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::prefix('admin')->group(function () {
    Route::middleware('auth:api')->group(function () {
        Route::middleware('isPermitted:view-post')->group(function () {
            Route::get('/posts', [PostController::class, 'index']);
            Route::get('/posts/{id}', [PostController::class, 'show']);
        });

        Route::middleware('isPermitted:create-post')->group(function () {
            Route::post('/posts', [PostController::class, 'store']);
        });

        Route::middleware('isPermitted:update-post')->group(function () {
            Route::put('/posts/{id}', [PostController::class, 'update']);
        });

        Route::middleware('isPermitted:delete-post')->group(function () {
            Route::delete('/posts/{id}', [PostController::class, 'destroy']);
        });
    });
});

