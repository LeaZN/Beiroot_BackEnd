<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/listings', ['App\Http\Controllers\ListingController', 'index']);

Route::get('/images', ['App\Http\Controllers\ImageController', 'index']);


Route::get('/listings/{id}', ['App\Http\Controllers\ListingController', 'show']);

Route::get('/images/{id}', ['App\Http\Controllers\ImageController', 'show']);

Route::get('/users', ['App\Http\Controllers\UserController', 'index']);






Route::group([
    'middleware' => 'jwt.auth',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/bookmarks', ['App\Http\Controllers\BookmarkController', 'store']);
    Route::post('/listings', ['App\Http\Controllers\ListingController', 'store']);
    Route::post('/users', ['App\Http\Controllers\UserController', 'store']);
    Route::post('/images', ['App\Http\Controllers\ImageController', 'store']);

    Route::get('/bookmarks', ['App\Http\Controllers\BookmarkController', 'index']);
//    Route::get('/users', ['App\Http\Controllers\UserController', 'index']);

    Route::get('/bookmarks/{id}', ['App\Http\Controllers\BookmarkController', 'show']);
    Route::get('/users/{id}', ['App\Http\Controllers\UserController', 'show']);

    Route::put('/bookmarks/{id}', ['App\Http\Controllers\BookmarkController', 'update']);
    Route::put('/listings/{id}', ['App\Http\Controllers\ListingController', 'update']);
    Route::put('/users/{id}', ['App\Http\Controllers\UserController', 'update']);
    Route::put('/images/{id}', ['App\Http\Controllers\ImageController', 'update']);


    Route::delete('/bookmarks/{id}', ['App\Http\Controllers\BookmarkController', 'destroy']);
    Route::delete('/listings/{id}', ['App\Http\Controllers\ListingController', 'destroy']);
    Route::delete('/users/{id}', ['App\Http\Controllers\UserController', 'destroy']);
    Route::delete('/images/{id}', ['App\Http\Controllers\ImageController', 'destroy']);


});
