<?php

use App\Http\Controllers\AdminPanel;
use App\Http\Controllers\GamePageController;
use App\Http\Controllers\Server\ServerController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

// Open pages
Route::get('/', function () {
    return view('mainpage'); // main page
});

Route::get('/offer', function (){
    return view('other.offer'); // Публичная оферта
});

Route::get('/games', [GamePageController::class, "gamesListPage"])->name("games");
Route::get('/servers', function (){
    return Redirect::route("games");
});
Route::get('/games/{link}', [GamePageController::class, "getGameByLink"])->name("toGame");
Route::get('/server/{id}', [ServerController::class, "getServerPage"])->name("server");
// End open pages

// Support pages
Route::get('/support', [SupportController::class, 'index']);
Route::get('/support/faq', [SupportController::class, 'faqPage']);
Route::get('/support/faq/answer/{id}', [SupportController::class, 'answerPage']);
Route::post('/support/faq/answer/helpful', [SupportController::class, 'isHelpful']);
Route::post('/support/faq/answer/suggestions', [SupportController::class, 'suggestions']);
Route::get('/support/faq/search', [SupportController::class, 'searchSuggestion']);
// End support section

// Authentication
Auth::routes();
// End authentication

// User panel
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// End user panel

// Admin panel
Route::get('/adminpanel', [AdminPanel::class, 'index'])->name("admin_main");
Route::get('/adminpanel/settings', [AdminPanel::class, 'settingPage'])->name("admin_settings");
Route::post('/adminpanel/updatesettings', [AdminPanel::class, "updateSettings"])->name("update_admin_settings");
// End admin panel


// Server controller
Route::post('/addserver', [ServerController::class, 'createServer'])->name("addserver");
Route::get('/addserver', [ServerController::class, 'index']);
Route::get('/editserver/{id}', [ServerController::class, 'editServer']);
Route::post('/editserver', [ServerController::class, 'saveServer'])->name("saveserver");
Route::get('/myservers', [ServerController::class, 'myServers'])->name("myservers");

Route::post('/server/loadFilters', [ServerController::class, "loadFilters"]);
Route::post('/server/checkCallback', [ServerController::class, "getResponseStatus"]);
// End server controller

// AJAX
Route::post('/game/get_games', [GamePageController::class, "getGamesList"]);
Route::post('/server/vote/{server_id}', [VoteController::class, "addVote"]);
// End AJAX
