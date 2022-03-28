<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Open pages
Route::get('/', function () {
    return view('mainpage'); // main page
});

Route::get('/offer', function (){
    return view('other.offer'); // Публичная оферта
});
// End open pages

// Support pages
Route::get('/support', [\App\Http\Controllers\SupportController::class, 'index']);
Route::get('/support/faq', [\App\Http\Controllers\SupportController::class, 'faqPage']);
Route::get('/support/faq/answer/{id}', [\App\Http\Controllers\SupportController::class, 'answerPage']);
Route::post('/support/faq/answer/helpful', [\App\Http\Controllers\SupportController::class, 'isHelpful']);
Route::post('/support/faq/answer/suggestions', [\App\Http\Controllers\SupportController::class, 'suggestions']);
Route::get('/support/faq/search', [\App\Http\Controllers\SupportController::class, 'searchSuggestion']);
// End support section

// Authentication
Auth::routes();
// End authentication

// User panel
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/addserver', [\App\Http\Controllers\Server\ServerController::class, 'createServer'])->name("addserver");
Route::get('/addserver', [\App\Http\Controllers\Server\ServerController::class, 'index']);
Route::get('/editserver/{id}', [\App\Http\Controllers\Server\ServerController::class, 'editServer']);
Route::post('/editserver', [\App\Http\Controllers\Server\ServerController::class, 'saveServer'])->name("saveserver");
Route::get('/myservers', [\App\Http\Controllers\Server\ServerController::class, 'myServers'])->name("myservers");
// End user panel

// Admin panel
Route::get('/adminpanel', [\App\Http\Controllers\AdminPanel::class, 'index'])->name("admin_main");
Route::get('/adminpanel/settings', [\App\Http\Controllers\AdminPanel::class, 'settingPage'])->name("admin_settings");
Route::post('/adminpanel/updatesettings', [\App\Http\Controllers\AdminPanel::class, "updateSettings"])->name("update_admin_settings");
// End admin panel

