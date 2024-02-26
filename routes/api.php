<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::post('post', [PostController::class, 'createPost']);
Route::post('update-post', [PostController::class, 'updatePost']);
Route::delete('post/{id}', [PostController::class, 'deletePost']);
Route::get('posts', [PostController::class, 'getAllPosts']);
Route::get('get-author/{id}', [PostController::class, 'getAuthor']);