<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\ServerData;
use App\Http\Services\Images\DrawBanner;
use App\Http\Services\MNSGameSEO;
use App\Models\Game;
use App\Models\Server;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class OtherController extends Controller
{
    use MNSGameSEO;

    /**
     * Страница продвижения
     *
     * @return Application|Factory|View
     */
    public function promotePage()
    {
        $this->setPageSEO(true, false, [
            "title" => "MNS Game - продвижение проекта",
            "description" => "Продвижение проекта на MNS Game",
            "url" => url("promote"),
        ]);

        return view("other.promote");
    }


    /**
     * Стартовая страница
     *
     * @return Application|Factory|View
     */
    public function mainPage()
    {
        $games = Game::select(["title", "short_link"])->get();
        $games_array = ["сервера", "мониторинг серверов", "майнкрафт", "csgo", "ip адреса", "айпи серверов", "топ", "список", "рейтинг", "рейтинг серверов"];

        foreach ($games as $game)
        {
            $games_array[] .= $game->title;
            $games_array[] .= $game->short_link;
        }

        $this->setPageSEO(false, false, [
            "description" => "MNS Game - это сервис мониторинга проектов и серверов для их владельцев и игроков различных жанров игр.",
            "opengraph" => [
                "title" => "MNS Game Мониторинг - сервис мониторинга различных игровых проектов.",
                "description" => "MNS Game - это сервис мониторинга проектов и серверов для игроков и владельцев. Присоединяйся!",
                "url" => url("/"),
                "image" => asset("/img/mnsgame.png"),
                "type" => "website"
            ],
            "keywords" => $games_array
        ]);

        return view('mainpage');
    }

    /**
     * Страница договора публичной оферты
     *
     * @return Application|Factory|View
     */
    public function offer()
    {
        $this->setPageSEO(true, false, [
            "title" => "MNS Game Мониторинг - Публичная оферта",
            "description" => "Договор публичной оферты MNS Game",
            "url" => url("offer"),
        ]);

        return view('other.offer');
    }

    /**
     * API: Получение баннера сервера
     *
     * @param $type
     * @param $id
     */
    public function getServerBanner($type, $id)
    {
        $server = Server::where("id", $id)->with(["game", "filters"])
            ->selectRaw("(select count(*) from `server_rates` where `servers`.`id` = `server_rates`.`server_id`) * ".ServerData::coefficient." + IFNULL((select rating from `server_ratings` where `servers`.`id` = `server_ratings`.`server_id`), 0) as `rating`")
            ->firstOrFail();

        DrawBanner::getImageByApi($type, $server->rating);
    }

    /**
     * AJAX: поиск сервера по названию
     *
     * @return JsonResponse
     */
    public function getServerBySearch(): JsonResponse
    {
        $servers = Server::where("title", "like", "%".request("title")."%")->limit(10)->get();

        return response()->json($servers);
    }
}
