<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/addserver', [\App\Http\Controllers\Server\ServerController::class, 'createServer'])->name("addserver");
Route::get('/addserver', [\App\Http\Controllers\Server\ServerController::class, 'index']);
Route::get('/editserver/{id}', [\App\Http\Controllers\Server\ServerController::class, 'editServer']);

