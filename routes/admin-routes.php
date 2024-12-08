<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {

    Route::middleware('auth:api')->group(function () {
        //roles
        Route::apiResource('roles', RoleController::class);
        Route::post('/roles', [RoleController::class, 'store']);
        Route::post('/roles/{id}/permissions', [RoleController::class, 'assignPermissions']);

        Route::apiResource('permissions', PermissionController::class);
    });

   Route::apiResource('users', UserController::class);
});
