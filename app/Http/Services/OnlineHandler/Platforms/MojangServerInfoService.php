<?php

namespace App\Http\Services\OnlineHandler\Platforms;

use App\Http\Services\OnlineHandler\ServerInfo;
use GuzzleHttp\Exception\GuzzleException;

class MojangServerInfoService extends ServerInfo
{
    /**
     * Setting default port of Mojang application
     */
    protected function checkPort(): void {}

    /**
     * Making query on MC API
     *
     * @return bool
     * @throws GuzzleException
     */
    protected function makeQuery(): bool
    {
        $data = $this->getApiData($this->serverPort ?
            "https://api.mcsrvstat.us/2/{$this->serverIp}:{$this->serverPort}" :
            "https://api.mcsrvstat.us/2/{$this->serverIp}"
        );

        if((bool)$data->online)
            $this->playersCount = $data->players->online;
        else
            return false;

        return true;
    }

    /**
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
