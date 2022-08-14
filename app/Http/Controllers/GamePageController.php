<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ServerData;
use App\Models\Game;
use App\Models\Server;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\JsonResponse;

class GamePageController extends Controller
{
    use SEOTools;

    public function gamesListPage(){
        $this->seo()->setDescription("MNS Game - это сервис мониторинга проектов и серверов для их владельцев и игроков различных жанров игр.");
        $this->seo()->opengraph()->setTitle("Игры на MNS Game Project");
        $this->seo()->opengraph()->setDescription("Страница игр на MNS Game Project");
        $this->seo()->opengraph()->setUrl(url("/games"));
        $this->seo()->opengraph()->addImage(asset("/img/mnsgame.png"));
        $this->seo()->opengraph()->setType("website");
        SEOMeta::addKeyword(["сервера", "мониторинг серверов", "ip адреса", "айпи серверов", "топ", "список", "рейтинг", "рейтинг серверов"]);

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
                ->selectRaw("`servers`.*,(select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`")
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

        $this->seo()->setDescription("MNS Game - это сервис мониторинга проектов и серверов для их владельцев и игроков различных жанров игр.");
        $this->seo()->opengraph()->setTitle("Мониторинг серверов ".$game->title);
        $this->seo()->opengraph()->setDescription($game->description);
        $this->seo()->opengraph()->setUrl(url("/games")."/".$game->short_link);
        $this->seo()->opengraph()->addImage(asset("/img/mnsgame.png"));
        $this->seo()->opengraph()->setType("website");
        SEOMeta::addKeyword(["сервера", "мониторинг серверов", $game->title, $game->short_link, "ip адреса", "айпи серверов", "топ", "список", "рейтинг", "рейтинг серверов"]);


        return view("game", compact("servers", "game"));
    }
}
