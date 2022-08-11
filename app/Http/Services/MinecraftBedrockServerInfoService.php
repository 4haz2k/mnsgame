<?php


namespace App\Http\Services;


use App\Http\Interfaces\ServerInfo;

class MinecraftBedrockServerInfoService extends ServerInfo
{
    /**
     * Setting default port of Mojang Bedrock minecraft application
     */
    protected function checkPort()
    {
        if($this->serverPort == null)
            $this->serverPort = "19132";
    }

    /**
     *
     * Making query on MC API
     *
     * @return bool
     */
    protected function makeQuery(): bool
    {
        self::checkPort();

        $response = json_decode(file_get_contents("https://api.mcsrvstat.us/bedrock/2/{$this->serverIp}:{$this->serverPort}"));

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
