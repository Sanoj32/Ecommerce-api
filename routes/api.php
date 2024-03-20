<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/users', [RegisteredUserController::class, 'store']);
Route::post('/login',[AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->get('/users', function (Request $request) {
    return response([
        'message' => 'User details retrieved successfully.',
        'user' => $request->user()
    ]);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('products', ProductController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});
