<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamePageController extends Controller
{
    public function gamesListPage(){
        return view("games");
    }
}
