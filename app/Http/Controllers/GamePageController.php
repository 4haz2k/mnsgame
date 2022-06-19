<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ServerData;
use App\Http\Services\ServerOnline;
use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

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
        $servers =
            Server::with(["game"])
                ->whereHas("game",  function($q) use($link) {
                    $q->where("short_link", $link);
                })
                ->selectRaw("`servers`.*,(select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + (select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`) as `rating`, @counter := @counter + 1 AS `placement`")
                ->orderByDesc("rating")
                ->paginate(ServerData::paginate);

        $game = Game::with("filters")->where("short_link", $link)->firstOrFail();

        return view("game", compact("servers", "game"));
    }
}
