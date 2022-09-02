<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FrendsController;
use App\Http\Controllers\LikrBlogController;
use App\Http\Controllers\MessagesController;
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

Route::prefix('v1')->group(function(){
    Route::post('register', [UserController::class, 'store']);
    Route::post('login', [AuthController::class, 'login']);
    Route::group(['middleware'=> ['auth:sanctum']], function(){
        Route::resource('user', UserController::class);
        Route::get('login-user', [UserController::class, 'getLoggedInUser']);
        Route::post('logOut', [AuthController::class, 'logOut']);

        Route::resource('blog', BlogController::class);
        Route::resource('like', LikrBlogController::class);
        Route::resource('comment', CommentsController::class);
        Route::get('check-friend', [FrendsController::class, 'checkFriendUser']);
        Route::resource('messages', MessagesController::class);

    });
});
