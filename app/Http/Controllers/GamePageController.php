<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;
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
        $servers = Server::with("game")->whereHas("game",  function($q) use($link) { $q->where("short_link", $link); })->paginate(5);
        $game = Game::with("filters")->where("short_link", $link)->firstOrFail();

        return view("game", compact("servers", "game"));
    }
}
