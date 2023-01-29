<?php

namespace App\Http\Services\OnlineHandler\Platforms;

use App\Http\Services\OnlineHandler\ServerInfo;

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
     */
    protected function makeQuery(): bool
    {
        $server_address = $this->serverPort == null ? $this->serverIp : $this->serverIp.":".$this->serverPort;

        $url = "https://api.steampowered.com/IGameServersService/GetServerList/v1/?filter=\appid\\{$this->serverAppId}\addr\\{$server_address}&key=".config("steam.STEAM_API_KEY");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $result = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($result, true);

        if(empty($result["response"])){
           return false;
        }

        $this->playersCount = $result["response"]["servers"][0]["players"];

        return true;
    }

    /**
     *
     * Getting players count
     *
     * @return int
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
