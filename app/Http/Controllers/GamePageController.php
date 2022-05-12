<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GamePageController extends Controller
{
    public function gamesListPage(){
        $games = Game::withCount("servers")->get();
        return view("games", compact("games"));
    }

    public function getGamesList(): JsonResponse
    {
        $games = Game::where("title", "like", "%".\request("title")."%")->withCount("servers")->get();

        return response()->json($games);
    }

    public function getGameByLink($link){
        $game = Game::where("short_link", $link)->with("servers")->firstOrFail();

        return view("game", compact("game"));
    }
}
