<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\UserController;
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

Route::get('/words', [DatabaseController::class, 'getWords']);

Route::post('/user', [UserController::class, 'createUser']);
Route::post('/chat', [DatabaseController::class, 'chat']);

Route::post('/loginUser', [UserController::class, 'loginUser']);
Route::post('/clicked', [DatabaseController::class, 'clickedButton']);
Route::post('/logout', [UserController::class, 'logOut']);

Route::get('/resetAllChats', [DatabaseController::class, 'resetChats']);
