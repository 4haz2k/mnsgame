<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ServerData;
use App\Http\Services\MNSGameSEO;
use App\Models\Game;
use App\Models\Server;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class GamePageController extends Controller
{
    use MNSGameSEO;

    /**
     * Get page with games
     *
     * @return Application|Factory|View
     */
    public function gamesListPage(){
        $this->setPageSEO(true);

        $games = Game::withCount("servers")->get();
        return view("games", compact("games"));
    }

    /**
     * Get game by link
     *
     * @param $link
     * @return Application|Factory|View
     */
    public function getGameByLink($link){
        $servers =
            Server::with(["game"])
                ->whereHas("game",  function($q) use($link) {
                    $q->where("short_link", $link);
                })
                ->selectRaw("`servers`.*,(select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`")
                ->groupBy('id')
                ->orderByDesc("rating");

        switch (request("projectType")){
            case ServerData::projectType["onlyAddresses"]:
                $servers = $servers->where("is_launcher","=", false);
                break;
            case ServerData::projectType["onlyLaunchers"]:
                $servers = $servers->where("is_launcher", "=", true);
                break;
            default:
                break;
        }

        if(request("categories")){
            $servers = $servers->whereHas("filters", function ($query){
               $query->whereIn("id", explode("-", request("categories")));
            });
        }

        $servers = $servers->paginate(ServerData::paginate);

        $game = Game::with(["filters" => function ($q){ $q->orderBy('filter'); }])->where("short_link", $link)->firstOrFail();

        $this->setPageSEO(false, request("categories") or request("projectType"), [
            "description" => "MNS Game - это сервис мониторинга проектов и серверов для их владельцев и игроков различных жанров игр.",
            "opengraph" => [
                "title" => "Мониторинг серверов " . $game->title,
                "description" => $game->description,
                "url" => url("/games") . "/" . $game->short_link,
                "image" => asset("/img/mnsgame.png"),
                "type" => "website"
            ],
            "keywords" => [
                "сервера",
                "мониторинг серверов",
                $game->title,
                $game->short_link,
                "ip адреса",
                "айпи серверов",
                "топ",
                "список",
                "рейтинг",
                "рейтинг серверов"
            ]
        ]);

        return view("game", compact("servers", "game"));
    }

    /**
     * AJAX: Get game list
     *
     * @return JsonResponse
     */
    public function getGamesList(): JsonResponse
    {
        $games = Game::where("title", "like", "%" . request("title") . "%")->withCount("servers")->get();

        return response()->json($games);
    }
}
