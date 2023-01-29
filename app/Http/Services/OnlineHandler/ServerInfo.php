<?php

namespace App\Http\Services\OnlineHandler;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

abstract class ServerInfo
{
    /**
     * @var string Server IP address
     */
    protected string $serverIp;

    /**
     * @var string|null Server Port
     */
    protected ?string $serverPort;

    /**
     * @var string|null Server Application Steam Id
     */
    protected ?string $serverAppId;

    /**
     * @var int Server players count
     */
    protected int $playersCount;

    /**
     * ServerInfo constructor.
     * @param string $serverAddress
     * @param null $appId
     */
    public function __construct(string $serverAddress, $appId = null)
    {
        list($this->serverIp, $this->serverPort) = array_pad(explode(":", $serverAddress), 2, null);
        $this->serverAppId = $appId;
    }

    /**
     *
     * Check is port of server default
     *
     */
    abstract protected function checkPort(): void;

    /**
     *
     * Making query by server app type
     *
     * @return bool Is query done
     */
    abstract protected function makeQuery(): bool;

    /**
     * Получение данных посредством Api
     *
     * @param string $uri
     * @return mixed
     * @throws GuzzleException
     */
    public function getApiData(string $uri)
    {
        $handlerStack = HandlerStack::create(new CurlHandler());
        $handlerStack->push(Middleware::retry(self::retryDecider(), self::retryDelay()));

        $client = new Client([
            'handler' => $handlerStack,
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        $response = $client->request(
            'GET',
            $uri
        )->getBody()->getContents();

        return json_decode($response);
    }

    /**
     * Повторение попыток
     *
     * @return Closure
     */
    private static function retryDecider(): Closure
    {
        return function ($retries, Request $request, Response $response = null, RequestException $exception = null) {
            if ($retries >= 5) {
                return false;
            }

            if ($exception instanceof ConnectException) {
                return true;
            }

            if ($response) {
                if ($response->getStatusCode() == 429 or $response->getStatusCode() == 500) {
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
    private static function retryDelay(): Closure
    {
        return function ($numberOfRetries) {
            return 1000 * $numberOfRetries;
        };
    }
}
