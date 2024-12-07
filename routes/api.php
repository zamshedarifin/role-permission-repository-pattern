<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {

    Route::get('health', function () {
        return response()->json([
            'status' => true,
            'message' => 'Server is running'
        ]);
    });

    include_once 'auth-routes.php';
    include_once 'admin-routes.php';
});
