<?php


namespace App\Http\Services;


use App\Http\Interfaces\ServerInfo;
use App\Http\Services\SampSocketPackets\SampQueryAPI;

class SampServerInfoService extends ServerInfo
{
    /**
     * Setting default port of Steam application
     */
    protected function checkPort()
    {
        if($this->serverPort == null)
            $this->serverPort = '7777';
    }

    /**
     *
     * Making query on Steam API
     *
     * @return bool
     */
    protected function makeQuery(): bool
    {
        self::checkPort();

        $query = new SampQueryAPI($this->serverIp, $this->serverPort);

        if ($query->isOnline()){
            $aInformation = $query->getInfo();

            $this->playersCount = $aInformation['players'];
        }
        else{
            return false;
        }

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