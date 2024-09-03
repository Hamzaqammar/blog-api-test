<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('posts', BlogPostController::class);
    Route::get('posts/{blogPost}/comments', [CommentController::class, 'index']);
    Route::post('posts/{blogPost}/comments', [CommentController::class, 'store']);
});

Route::fallback(function (Request $request) {
    return response()->json(['message' => 'You are not logged in.'], 401);
});