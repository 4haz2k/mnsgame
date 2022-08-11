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
                        $server->online = $steamServerInfoService->getPlayersCount();
                        $server->save();
                        unset($steamServerInfoService);
                        break;
                    case GamesType::mojangServer:
                        $mojangServerInfoService = new MojangServerInfoService($server->server_data);
                        $server->online = $mojangServerInfoService->getPlayersCount();
                        $server->save();
                        unset($mojangServerInfoService);
                        break;
                    case GamesType::samp:
                        $sampServerInfoService = new SampServerInfoService($server->server_data);
                        $server->online = $sampServerInfoService->getPlayersCount();
                        $server->save();
                        unset($sampServerInfoService);
                        break;
                    case GamesType::minecraftBedrock:
                        $minecraftBedrock = new MinecraftBedrockServerInfoService($server->server_data);
                        $server->online = $minecraftBedrock->getPlayersCount();
                        $server->save();
                        unset($minecraftBedrock);
                        break;
                    default:
                        break;
                }
            }
        }
    }
}
