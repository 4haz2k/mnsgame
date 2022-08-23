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
                switch ($server->game->platform){
                    case GamesType::steamServer:
                        $steamServerInfoService = new SteamServerInfoService($server->server_data, $server->game->steam_app_id);
                        $online = $steamServerInfoService->getPlayersCount();
                        $server->online = $online;
                        $server->save();
                        $this->saveOnlineLog($server->id, $online);
                        unset($steamServerInfoService);
                        break;
                    case GamesType::mojangServer:
                        $mojangServerInfoService = new MojangServerInfoService($server->server_data);
                        $online = $mojangServerInfoService->getPlayersCount();
                        $server->online = $online;
                        $server->save();
                        $this->saveOnlineLog($server->id, $online);
                        unset($mojangServerInfoService);
                        break;
                    case GamesType::samp:
                        $sampServerInfoService = new SampServerInfoService($server->server_data);
                        $online = $sampServerInfoService->getPlayersCount();
                        $server->online = $online;
                        $server->save();
                        $this->saveOnlineLog($server->id, $online);
                        unset($sampServerInfoService);
                        break;
                    case GamesType::minecraftBedrock:
                        $minecraftBedrock = new MinecraftBedrockServerInfoService($server->server_data);
                        $online = $minecraftBedrock->getPlayersCount();
                        $server->online = $online;
                        $server->save();
                        $this->saveOnlineLog($server->id, $online);
                        unset($minecraftBedrock);
                        break;
                    default:
                        break;
                }
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
