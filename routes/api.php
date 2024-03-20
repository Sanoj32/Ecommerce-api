<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/users', [RegisteredUserController::class, 'store']);
Route::post('/login',[AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->get('/users', function (Request $request) {
    return $request->user();
});
