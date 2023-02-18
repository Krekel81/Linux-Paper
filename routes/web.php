<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\DatabaseController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/register', function () {
    return view('register', ["users" => User::all()]);
})->name('register');


Route::get('/login', function () {
    return view('login', ["users" => User::all()]);
})->name('login');

Route::get('/todo', function () {
   return view('todo');
})->name('todo');

Route::get('/landing', [DatabaseController::class, 'showLanding'])->name('landing');
