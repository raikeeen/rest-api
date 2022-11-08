<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('new-password', [UserController::class, 'passwordUpdate']);
Route::post('login', [UserController::class, 'login']);
Route::post('reset-password', [UserController::class, 'passwordReset']);
Route::resource('users', UserController::class)->except(['update', 'index', 'show']);
Route::middleware('auth:api')->group(function () {
    Route::resource('users', UserController::class)->only(['update', 'index', 'show']);
});
