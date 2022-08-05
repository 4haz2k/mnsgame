<?php
namespace App\Http\Services;

use App\Http\Interfaces\ServerInfo;
use GuzzleHttp\Exception\GuzzleException;

class MojangServerInfoService extends ServerInfo
{
    /**
     * Setting default port of Mojang application
     */
    protected function checkPort()
    {
        if($this->serverPort == null)
            $this->serverPort = "25565";
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

//        $response = MinecraftServerStatus::query($this->serverIp, $this->serverPort);

        $response = json_decode(file_get_contents("https://api.mcsrvstat.us/2/{$this->serverIp}:{$this->serverPort}"));

//        $this->playersCount = $response["players"];

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
