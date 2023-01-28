<?php

namespace App\Http\Services;

use App\Http\Interfaces\ServerInfo;
use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

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

        $handlerStack = HandlerStack::create(new CurlHandler());
        $handlerStack->push(Middleware::retry($this->retryDecider(), $this->retryDelay()));

        $client = new Client([
            'handler' => $handlerStack,
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        $response = $client->request(
            'GET',
            "https://api.mcsrvstat.us/2/{$this->serverIp}:{$this->serverPort}"
        )->getBody()->getContents();

        $data = json_decode($response);

        if((bool)$data->online)
            $this->playersCount = $data->players->online;
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
        if(self::makeQuery()){
            return $this->playersCount;
        }
        else{
            return 0;
        }
    }

    /**
     * Повторение попыток
     *
     * @return Closure
     */
    private function retryDecider()
    {
        return function ($retries, Request $request, Response $response = null, RequestException $exception = null) {

            if ($retries >= 5) {
                return false;
            }

            if ($exception instanceof ConnectException) {
                return true;
            }

            if ($response) {
                if ($response->getStatusCode() == 419 ) {
                    return true;
                }
            }

            return false;
        };
    }

    /**
     * Задрежка 1s 2s 3s 4s 5s
     *
     * @return Closure
     */
    private function retryDelay()
    {
        return function ($numberOfRetries) {
            return 1000 * $numberOfRetries;
        };
    }
}
