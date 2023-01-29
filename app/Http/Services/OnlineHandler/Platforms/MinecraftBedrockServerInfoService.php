<?php

namespace App\Http\Services\OnlineHandler\Platforms;

use App\Http\Services\OnlineHandler\ServerInfo;
use GuzzleHttp\Exception\GuzzleException;

class MinecraftBedrockServerInfoService extends ServerInfo
{
    /**
     * Setting default port of Mojang Bedrock minecraft application
     */
    protected function checkPort(): void {}

    /**
     *
     * Making query on MC API
     *
     * @return bool
     * @throws GuzzleException
     */
    protected function makeQuery(): bool
    {
        $response = $this->getApiData($this->serverPort ?
                "https://api.mcsrvstat.us/bedrock/2/{$this->serverIp}:{$this->serverPort}" :
                "https://api.mcsrvstat.us/bedrock/2/{$this->serverIp}"
        );

        if((bool)$response->online)
            $this->playersCount = $response->players->online;
        else
            return false;

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
        if(static::makeQuery()){
            return $this->playersCount;
        }
        else{
            return 0;
        }
    }
}
