<?php
namespace App\Http\Services;

use App\Http\Interfaces\ServerInfo;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

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
     * @throws GuzzleException
     */
    protected function makeQuery(): bool
    {
        self::checkPort();

        try {
            $query = new GuzzleClient();

            $result = $query->request("GET", "https://mcapi.us/server/status?ip={$this->serverIp}&port={$this->serverPort}");

            $result = json_decode($result->getBody(), true);

        } catch (ClientException $e) {
            Log::error('MNS Game Mojang Service module: '.$e->getMessage());
            $result["status"] = "error";
        }

        if($result["status"] == "error"){
            return false;
        }

        $this->playersCount = $result["players"]["now"];

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
