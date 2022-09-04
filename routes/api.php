<?php

use App\Http\Controllers\OtherController;
use Illuminate\Support\Facades\Route;

Route::get('/server/banner/{type}/{id}', [OtherController::class, "getServerBanner"]);
