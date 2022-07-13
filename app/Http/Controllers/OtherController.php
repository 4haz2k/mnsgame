<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\JsonResponse;

class OtherController extends Controller
{
    use SEOTools;

    public function promotePage(){
        $this->seo()->setDescription("MNS Game - это сервис мониторинга проектов и серверов для их владельцев и игроков различных жанров игр.");
        $this->seo()->opengraph()->setTitle("MNS Game - продвижение проекта");
        $this->seo()->opengraph()->setDescription("Продвижение проекта на MNS Game");
        $this->seo()->opengraph()->setUrl(url("promote"));
        $this->seo()->opengraph()->addImage(asset("/img/mnsgame.png"));
        $this->seo()->opengraph()->setType("website");
        SEOMeta::addKeyword(["сервера", "мониторинг серверов", "ip адреса", "айпи серверов", "топ", "список", "рейтинг", "рейтинг серверов"]);
        return view("other.promote");
    }

    public function getServerBySearch(): JsonResponse
    {
        $servers = Server::where("title", "like", "%".request("title")."%")->limit(10)->get();

        return response()->json($servers);
    }

    public function mainPage(){
        $this->seo()->setDescription("MNS Game - это сервис мониторинга проектов и серверов для их владельцев и игроков различных жанров игр.");
        $this->seo()->setTitle("MNS Game - сервис мониторинга различных игровых проектов.");
        $this->seo()->opengraph()->setTitle("MNS Game Project - сервис мониторинга различных игровых проектов.");
        $this->seo()->opengraph()->setDescription("MNS Game - это сервис мониторинга проектов и серверов для игроков и владельцев. Присоединяйся!");
        $this->seo()->opengraph()->setUrl(url("/"));
        $this->seo()->opengraph()->addImage(asset("/img/mnsgame.png"));
        $this->seo()->opengraph()->setType("website");
        $games = Game::select(["title", "short_link"])->get();
        $games_array = ["сервера", "мониторинг серверов", "майнкрафт", "csgo", "ip адреса", "айпи серверов", "топ", "список", "рейтинг", "рейтинг серверов"];

        foreach ($games as $game){
            $games_array[] .= $game->title;
            $games_array[] .= $game->short_link;
        }

        SEOMeta::addKeyword($games_array);
        return view('mainpage'); // main page
    }
}
