<?php

namespace App\Http\Services\OnlineHandler\Platforms;

use App\Http\Services\OnlineHandler\ServerInfo;
use GuzzleHttp\Exception\GuzzleException;

class SteamServerInfoService extends ServerInfo
{
    /**
     * Setting default port of Steam application
     */
    protected function checkPort(): void {}

    /**
     *
     * Making query on Steam API
     *
     * @return bool
     * @throws GuzzleException
     */
    protected function makeQuery(): bool
    {
        $server_address = $this->serverPort == null ? $this->serverIp : $this->serverIp.":".$this->serverPort;

        $data = $this->getApiData(
            "https://api.steampowered.com/IGameServersService/GetServerList/v1/?filter=\appid\\{$this->serverAppId}\addr\\{$server_address}&key=" . config("steam.STEAM_API_KEY")
        );

        if(empty((array)$data->response)){
           return false;
        }

        $this->playersCount = $data->response->servers[0]->players;

        return true;
    }

    /**
     *
     * Getting players count
     *
     * @return int
     * @throws GuzzleException
     */
    public function getPlayersCount(): int
    {
        if(self::makeQuery()){
            return $this->playersCount;
        }
        else{
            return 0;
        }
    }
}
