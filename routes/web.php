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

// Open pages
Route::get('/', function () {
    return view('mainpage'); // main page
});

Route::get('/offer', function (){
    return view('other.offer'); // Публичная оферта
});

Route::get('/support', [\App\Http\Controllers\SupportController::class, 'index']);
Route::get('/support/faq', [\App\Http\Controllers\SupportController::class, 'faqPage']);


// Authentication
Auth::routes();

// User panel
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/addserver', [\App\Http\Controllers\Server\ServerController::class, 'createServer'])->name("addserver");
Route::get('/addserver', [\App\Http\Controllers\Server\ServerController::class, 'index']);
Route::get('/editserver/{id}', [\App\Http\Controllers\Server\ServerController::class, 'editServer']);
Route::post('/editserver', [\App\Http\Controllers\Server\ServerController::class, 'saveServer'])->name("saveserver");
Route::get('/myservers', [\App\Http\Controllers\Server\ServerController::class, 'myServers']);

// Admin panel
Route::get('/adminpanel', [\App\Http\Controllers\AdminPanel::class, 'index'])->name("admin_main");
Route::get('/adminpanel/settings', [\App\Http\Controllers\AdminPanel::class, 'settingPage'])->name("admin_settings");
Route::post('/adminpanel/updatesettings', [\App\Http\Controllers\AdminPanel::class, "updateSettings"])->name("update_admin_settings");


