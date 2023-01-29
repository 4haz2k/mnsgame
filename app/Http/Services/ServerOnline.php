<?php
namespace App\Http\Services;

use App\Http\Interfaces\GamesType;
use App\Models\Server;

/**
 * Обновление онлайна серверов
 * @package App\Http\Services
 */
class ServerOnline
{
    private $server_list;

    public function __construct()
    {
        $this->server_list = Server::with("game")->get();
    }

    public function updateOnline(){
        foreach ($this->server_list as $server) {
            if(!$server->is_launcher){
                /** @var  $gameServiceClass MojangServerInfoService|SteamServerInfoService|SampServerInfoService|MinecraftBedrockServerInfoService */
                $gameServiceClass = GamesType::GAME_TYPES[$server->game->platform];

                $gameServiceClass = new $gameServiceClass($server->server_data, $server->game->steam_app_id);
                $online = $gameServiceClass->getPlayersCount();

                $server->online = $online;
                $server->save();

                $this->saveOnlineLog($server->id, $online);
                unset($gameServiceClass);
            }
        }
    }

    private function saveOnlineLog($server_id, $online){
        $server_online = new \App\Models\ServerOnline();

        $server_online->server_id = $server_id;
        $server_online->online = $online;

        $server_online->save();
    }
}
