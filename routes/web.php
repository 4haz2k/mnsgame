<?php

use App\Http\Controllers\AdminPanel;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GamePageController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Server\ServerController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', [OtherController::class, "mainPage"]);

Route::get('/offer', [OtherController::class, "offer"])->name("offer");

Route::get('/games', [GamePageController::class, "gamesListPage"])->name("games");
Route::get('/servers', function (){
    return Redirect::route("games");
});
Route::get('/games/{link}', [GamePageController::class, "getGameByLink"])->name("toGame");
Route::get('/server/{id}', [ServerController::class, "getServerPage"])->name("server")->withoutMiddleware(['auth']);
Route::get('/promote', [OtherController::class, "promotePage"]);
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
Route::get('/social/auth/{provider}', [LoginController::class, "redirectToProvider"])->name("auth.social");
Route::get('/social/auth/{provider}/callback', [LoginController::class, "handleProviderCallback"])->name("auth.social.callback");
Route::get('/payment/redirect', [PaymentController::class, "paymentCreate"])->name("payment.create");
Route::get('/payment/callback', [PaymentController::class, "paymentCallback"])->name("payment.callback");
Route::any('/payment/callback/yandex', [PaymentController::class, "paymentCallbackYandex"])->name("payment.callback.yandex");
// End authentication

// User panel
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/settings', [App\Http\Controllers\HomeController::class, 'settings'])->name('settings');
Route::post('/settings/update', [App\Http\Controllers\HomeController::class, 'updateSettings'])->name('updateSettings');
Route::get('/paymentHistory', [App\Http\Controllers\HomeController::class, 'getPaymentHistory'])->name('paymentHistory');
Route::get('/notifications', [App\Http\Controllers\HomeController::class, 'getNotifications'])->name('notifications');
Route::get('/notification/{id}', [App\Http\Controllers\HomeController::class, 'goToNotification']);
// End user panel

// Admin panel
Route::get('/adminpanel', [AdminPanel::class, 'index'])->name("admin_main");
Route::get('/adminpanel/settings', [AdminPanel::class, 'settingPage'])->name("admin_settings");
Route::get('/adminpanel/questions', [AdminPanel::class, 'questionsPage'])->name("admin_questions");
Route::get('/adminpanel/filters', [AdminPanel::class, 'filtersPage'])->name("admin_filters");
Route::post('/adminpanel/questions', [AdminPanel::class, 'questionsPageAdd'])->name("add_admin_question");
Route::post('/adminpanel/filters', [AdminPanel::class, 'filtersPageAdd'])->name("add_admin_filters");
Route::post('/adminpanel/updatesettings', [AdminPanel::class, "updateSettings"])->name("update_admin_settings");
// End admin panel


// Server controller
Route::post('/addserver', [ServerController::class, 'createServer'])->name("addserver");
Route::get('/addserver', [ServerController::class, 'index']);
Route::get('/editserver/{id}', [ServerController::class, 'editServer']);
Route::post('/editserver', [ServerController::class, 'saveServer'])->name("saveserver");
Route::get('/deleteserver/{id}', [ServerController::class, 'deleteServer'])->name("deleteserver");
Route::get('/myservers', [ServerController::class, 'myServers'])->name("myservers");

Route::post('/server/loadFilters', [ServerController::class, "loadFilters"]);
Route::post('/server/checkCallback', [ServerController::class, "getResponseStatus"]);
// End server controller

// AJAX
Route::post('/game/get_games', [GamePageController::class, "getGamesList"]);
Route::post('/server/vote/{server_id}', [VoteController::class, "addVote"]);
Route::post('/servers/search', [OtherController::class, "getServerBySearch"]);
// End AJAX

// Telegram
Route::post(config("telegram.bots.mnsgame.token")."/webhook", [\App\Http\Controllers\TelegramBotController::class, "eventHandler"]);
// End Telegram
