<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    Route::get('check-server', function () {
        return response()->json([
            'message' => 'Happy Coding :)',
            'status' => true,
        ]);
    });
    include_once 'auth-routes.php';
    include_once 'admin-routes.php';
    include_once 'post-routes.php';
});
