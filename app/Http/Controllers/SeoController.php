<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function generateSitemap(): Response
    {
        return response()->view("sitemaps.links")->header('Content-Type', 'text/xml');
    }

    public function generateDefaultSitemap(): Response
    {
        return response()->view("sitemaps.default")->header('Content-Type', 'text/xml');
    }

    public function generateServersSitemap(): Response
    {
        $servers = Server::all(["id", "created_at"]);
        return response()->view("sitemaps.servers", compact("servers"))->header('Content-Type', 'text/xml');
    }

    public function generateGamesSitemap(): Response
    {
        $games = Game::with(["filters"])->get();
        return response()->view("sitemaps.games", compact("games"))->header('Content-Type', 'text/xml');
    }
}
