<?php


namespace App\Http\Services;


use App\Http\Interfaces\ServerInfo;

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

        $url = "https://mcapi.us/server/status?ip={$this->serverIp}&port={$this->serverPort}";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $result = curl_exec($ch);

        curl_close($ch);

        $result = json_decode($result, true);

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
