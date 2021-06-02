<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [UserController::class,'login']);
Route::post('register', [UserController::class,'store']);

Route::middleware('jwt.verify')->group(function () {
    Route::resource('movies', MoviesController::class );
    Route::resource('comments', CommentsController::class);
    Route::prefix('comments/group')->group(function () {
        Route::get('filtered_by_movie_id/{movie_id}',[CommentsController::class,'getCommentsFilteredByMovie']);
    });
});


